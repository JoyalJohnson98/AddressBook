<?php
//how to connect with database
include 'connection.php';

//Isset function
//$_POST method
//$_GET method
if(
    isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["country"]) 
    && isset($_POST["password"]) 
  )
{   
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $country=$_POST['country'];
    $password=$_POST['password'];
    $confirmPassword=$_POST['passwordRe'];


    //Server side validation
    $namebool = false;
    $emailbool = false;
    $phonebool = false;
    $passbool = false;
    $countrybool = false;

    $nameerror = "";
    $emailerror = "";
    $phoneerror = "";
    $passworderror = "";
    $countryerror = "";
   
  //Validation  for name that will accept alphabetically only.
    if(empty($name)){
        $nameerror= "Enter name";
        $namebool = false;
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$name)){
            $nameerror="Name must be enter in alphabet";
            $namebool = false;
        }
        else{
            $namebool = true;
        }
       
    }
   //Email validation
    if(empty($email)){
        $emailerror="Enter Email";
        $emailbool = false;
    }
    else{
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            
            $emailerror="Email is not correct";
            $emailbool = false;
        }
        else{
            $emailbool = true;
        }
    }
   //Phone validation
    if(empty($phone)){
        $phoneerror="Enter phone";
        $phonebool = false;
    }
    else{

        if((!is_numeric($phone)) || (strlen($phone) != 10))  {
            $phoneerror=" Phone must be numeric value and only 10 digits!";
            $phonebool = false;
        }  
        else{
            $phonebool = true;
        }
    }
    //Country input Validation
    if(empty($country)){
        $countryerror="Select  country";
        $countrybool = false;
    }
    else{
        $countrybool = true;
    }

   //Password validation
   $passwordLength=strlen ($password);
    //echo $passwordLength."<br>";
    if(empty($password)){
        $passworderror= "Enter password";
        $passbool = false;
    }
    else{
        if(!preg_match("/[a-z]/",$password) || !preg_match("/[^\w]/",$password) 
        || !preg_match("/[A-Z]/",$password) || !preg_match("/[0-9]/",$password) || !$passwordLength > 8)
        {
            $passworderror="please enter at least one lower case,uppercase,number,spec.character and min 8 character";  
            $passbool = false;
        }
        else{
            if($password == $confirmPassword){
            $passbool = true;
            }
            else{
                $passworderror= "Both password must be same" ;
                $passbool= false;
            }
        }
    }

   
   //checking if email is already exist
   $sql="select * from user where Email='$email'";
   $res=mysqli_query($conn,$sql);
   if (mysqli_num_rows($res) > 0) {
      $row = mysqli_fetch_assoc($res);
      if($email== isset($row['Email']))
        {
        //   echo "email already exists";
          echo '<script>alert("Email already exists");window.location.href="Login.php";</script>';
        
         }
    }
  else{
     if($namebool == true && $passbool == true){
    $query ="INSERT INTO user (Name,Email,Phone,Country,Password) VALUES ('$name','$email','$phone','$country','$password')";
    $result = mysqli_query($conn,$query);
    if($result){
        echo '<script>alert("Register successfully");window.location.href="Login.php";</script>';
        
      
    }
   }
   }


}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <style type="text/css">
        h4 {
            color: #0e59a5;
            text-align: center;
            margin-left:-12vw;
        }
        label {
            color: #0e59a5;
        }
        #img{
            display: block;
           margin-left: auto;
           margin-right: auto;
           width: 50%;
        }
      
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg " style="background-color:#0e59a5;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="color:white" ><img src="Images/contactlogo.png" alt="#" height="40px" width="40px" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2  mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:white">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:white">Abouts Us</a>
                    </li>
                </ul>
                <button class="btn btn-primary">
                    <span class="navbar-text"><a href="Login.php"style="text-decoration: none;color:white">Login</a></span>
                </button>
            </div>
        </div>
    </nav>

    <div class="col-md-12" >
        <!-- <h1 id="img">
            <img src="Images/addressbook.jpg" alt="" style="width:10%;" />
        </h1> -->
    </div>
    <form class="container" style="margin-left:32vw;" action="" method="POST" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-md-6">
                <h4>Register Here!</h4>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter name" class="form-control" style="width:75%" />
                    <span style="color:red"><?php if(isset($nameerror)){
                        echo $nameerror;
                        }?></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter email" class="form-control" style="width:75%" />
                    <span style="color:red"><?php if(isset($emailerror)){
                        echo $emailerror;
                        }?></span>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="number" name="phone" placeholder="Enter phone" class="form-control" style="width:75%" />
                    <span style="color:red"><?php if(isset($phoneerror)){
                        echo $phoneerror;
                        }?></span>
                </div>
                <div class="form-group">
                    <label>Select country</label>
                    <select class="form-control" id="sel1" name="country" style="width:75%">
                        <option value=""></option>
                        <option value="India">India</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Srilanka">Srilanka</option>
                    </select>
                    <span style="color:red"><?php if(isset($countryerror)){
                        echo $countryerror;
                        }?></span>
                </div>

                <div class="form-group">
                    <label>Password </label>
                    <input type="password" name="password" placeholder="Enter password" class="form-control" style="width:75%" />
                    <span style="color:red">
                        <?php 
                        if(isset($passworderror)){
                        echo $passworderror;
                        }
                        ?>
                    </span>
                </div>
                <div class="form-group">
                    <label>Re-Enter Password</label>
                    <input type="Password" name="passwordRe" id="passwordRe" placeholder="Re-enter password" class="form-control" style="width:75%" />
                    <span style="color:red"><?php if(isset($confpassworderror)){
                        echo $confpassworderror;
                        }?></span>
                </div>
                <br>
                <button class="btn btn-primary" type="submit" style="margin-left:9vw;">Submit</button>
                <button class="btn btn-danger"><a href="index.php" style="text-decoration: none;color:white">Cancel</a></button>

            </div>

        </div>


    </form>
</body>

</html>