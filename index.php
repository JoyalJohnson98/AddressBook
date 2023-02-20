<!DOCTYPE html>
<html>
<head>
  <title>Address Book</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image:  url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZnpsrb6mp5xciB-fxBpf7ZfaZbE9pIfWFjw8JVeBaruuCr8lnd3luDgGOT3ajvkFBiww&usqp=CAU");
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      background-size: 100vw 100vh;
      margin: 0;
      padding: 0;
      
    }

    header {
      background-color: black;
      color: red;
      padding: 20px;
      display: flex;
     justify-content: center;
      margin-top:-10px;
      
    }

    header h1  {
      margin: 0;
      margin-top: 20px;
      text-align: center;
      margin-left: 450px;

    }

    header a {
      margin: 0px;
      margin-top:20px;
    }

    /* nav {
      background-color: red;
      color: black;
      display: flex;
      justify-content: flex-end;
      padding: 30px;
    }

    nav a {
      color: black;
      text-decoration: none;
      padding: 0 5px 0 5px;
    } */
    .links a{
      text-decoration: none;
      font-size: 20px;
      color: red;
      margin: 25px 10px 0 5px;;
          
    }
    .links{
      display: flex;
      margin-left: 400px;
    }
    
   
    .container {
      max-width: 960px;
      margin: 0 auto;
      text-align: center;
      padding: 50px 0;
      font-size: 1.5em;
      /* background-image:  url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_F8Wwa4Yq_gEIA-nPNTfrhJ_dtnvCoHfdTg&usqp=CAU");
      background-repeat: no-repeat; */
      
    }

    /* .container h2 {
      font-size: 36px;
      margin-bottom: 20px;
      color: grey;
    }

    .container p {
      font-size: 18px;
      line-height: 1.5;
    } */
  </style>
</head>
<body>
  <div class="container-fluid">
  <header>
    <div class="heading">
    <h1>Address Book </h1>
    </div>
    
    <div class="links">
    <a href="register.php" >Register</a>
    <a href="login.php" >Login</a>
    </div>
    
    <!-- <a href="register.php" style="color:red; margin-left:1000px; padding:10px;">Register</a>
    <a href="login.php" style="color:red">Login</a> -->
  </header>
  <!-- <nav>
    
    <a href="register.php" style="color:black">Register</a>
    <a href="login.php" style="color:black">Login</a>
  </nav> -->
  <div class="container">
  
    
    <p style="color:white">An address book is a database that stores names, addresses and other contact information for a computer user.<p>
    <p style="color:white; font-size: 1em;"> So welcome to my Address Book.</p>
    </div>
    </div>
</body>
</html>
