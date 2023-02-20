


<?php

session_start();
if (!isset($_SESSION['email'])) 
{


  header("Location: login.php");
}


$servername = "localhost";
$username = "root";
$password = "joyaljohnson";
$dbname = "addressbook";

$name_error = "";
$phone_error = "";
$state_error = "";
$country_error = "";
$pincode_error = "";
$is_valid = true;







// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id'])) 
{

    

$id = $_GET['id'];
$sql = "SELECT id, name, phone, state, country, photo, pincode FROM address WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);




}



if(isset($_POST['update'])) 
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $photo = $_POST['photo'];
    $pincode = $_POST['pincode'];

    if($photo == "")
    {
      $photo = $row['photo'];
    }


    if (!preg_match('/^[\p{L} ]+$/u', $name)) {
      $name_error = "Name must contain only letters";
      $is_valid = false;
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
      $phone_error = "Mobile must contain 10 digits";
      $is_valid = false;
    }

    if (!preg_match("/^[1-9][0-9]{5}$/", $pincode)){
      $pincode_error = "Invalid pin code";
      $is_valid = false;


    }

    if (empty($state)) 
    {
      $state_error = "Address cant be empty";
      $is_valid = false;
    }
    if (empty($country)) 
    {
      $country_error = "Address cant be empty";
      $is_valid = false;
    }

    if ($is_valid)
    {


    $sql = "UPDATE address SET name='$name', phone='$phone', state='$state', country='$country', photo='$photo', pincode='$pincode' WHERE id=$id";
    if (mysqli_query($conn, $sql))
     {
      
     
      
        // header("Location: list.php");
        echo '<script>alert("updated successfully ");
        location.href = "list.php";
        </script>';
        // exit;
       

    }
     else 
     {
      echo "Error updating record: " . mysqli_error($conn);
      
    }
  }
}
mysqli_close($conn);


?>





<html>
  <head>
    <title>Update Record</title>
    <style>
          .error{color : red;}

      body {
        font-family: Arial, sans-serif;
        background-color: red;
        margin: 0px;
      }
      nav {
        background-color: black;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        padding: 20px;
      }
      nav a {
        color: #f2f2f2;
        text-decoration: none;
        margin-right: 20px;
      }
      form {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px #999;
        margin: 50px auto;
        width: 500px;
        text-align: center;
      }
      input[type="text"], input[type="file"],input[type = "number"] {
        padding: 10px;
        margin-bottom: 20px;
        width: 100%;
        border-radius: 5px;
        border: 1px solid #333;
      }
      input[type="submit"] {
        background-color: red;
        color: black;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
      }
      input[type="submit"]:hover {
        background-color: black;
        color: red;
      }
    </style>
  </head>
  <body>
    <nav>
      
      <a href="list.php" style="margin-left:1110px; color:red;">Profile</a>
      <a href="index.php" style="color:red">Home</a>
    </nav>
    <form action="" method="post">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <label for="name" style="color: red; display:flex; justify-content:flex-start;">Name</label>
       <input type="text" name="name" value="<?php echo $row['name']; ?>">
      <span class="error"><?php echo $name_error; ?></span><br><br>

      <label for="phone" style="color: red; display:flex; justify-content:flex-start;">Phone</label>
      <input type="number" name="phone" value="<?php echo $row['phone']; ?>">
      <span class="error"><?php echo $phone_error; ?></span><br><br>

      <label for="state" style="color: red; display:flex; justify-content:flex-start;">State</label>
       <input type="text" name="state" value="<?php echo $row['state']; ?>">
      <span class="error"><?php echo $state_error; ?></span><br><br>

      <label for="country" style="color: red; display:flex; justify-content:flex-start;">Country</label>
       <input type="text" name="country" value="<?php echo $row['country']; ?>">
      <span class="error"><?php echo $country_error; ?></span><br><br>

      <label for="photo" style="color: red; display:flex; justify-content:flex-start;">Photo</label>
       <input type="file" name="photo" onchange="previewImage(event);" value=""><span><?php echo $row['photo'];?></span>
       <img id = "preview" style = "max-width : 100px;"><br><br> 

       <label for="name" style="color: red; display:flex; justify-content:flex-start;">Pincode</label>
       <input type="number" name="pincode" value="<?php echo $row['pincode']; ?>">
      <span class="error"><?php echo $pincode_error; ?></span><br><br>
      
      

      <input type="submit" name="update" value="Update">
      
    </form>
    <script> 
    function previewImage(event) 
    {
      var reader = new FileReader(); 
      reader.onload = function() 
      {
         var output = document.getElementById('preview');
          output.src = reader.result; 
      } 
      reader.readAsDataURL(event.target.files[0]); 
      
    } </script>
  </body>
</html>
