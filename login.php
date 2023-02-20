<!DOCTYPE html>
<html>

<head>
  <title>Address Book - Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: red;
    }

    header {
      background-color: black;
      color: white;
      padding: 20px;
      text-align: center;
      margin: -10px;
    }

    header h1 {
      margin: 0;
    }

    .container {
      /* max-width: 960px;
      margin: 50px auto; */
      text-align: center;
      padding: 50px;
      /* background-color: cyan;
      color: red;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2); */
    }

    form {
      width: 50%;
      margin: 0 auto;
      text-align: left;
      padding: 50px;
    }

    input[type="email"],
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      font-size: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
      
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: black;
      color: white;
      font-size: 1.1em;
      border: 0;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: white;
      color: red;
    }

    .links {
      text-align: center;
      margin-top: 20px;
    }

    .links a {
      color: navy;
      text-decoration: none;
    }

    .links a:hover {
      color: #555;
    }
  </style>
</head>

<body>
  <header>
    <h1>Address Book</h1>
  </header>
  <div class="container">
    <h2 style="color:white; font-size: 2em;">Login</h2>
    <form action="" method="post">
      <input type="email" name="email" placeholder="Email" required><br><br>
      <!-- <input type="password" name="password" placeholder="Password" required> -->
      <input type="password" name="password" value="" id="myInput" placeholder="Password" required><br><br>
      <input type="checkbox" onclick="myFunction()">Show Password

      <br>
      <br>
      <script>
        function myFunction() {
          var x = document.getElementById("myInput");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
      </script>

      <input type="submit" name="submit" value="Submit">
    </form>
    <div class="links">
      <p style="color:white;">Don't have a account yet? <a href="register.php" style="color:white;"> Register here ®</a>
      <p>
        <a href="index.php" style="color:white;">Back to Home🏡</a>
    </div>
  </div>
</body>

</html>


<?php


$servername = "localhost";
$username = "root";
$password = "joyaljohnson";
$dbname = "addressbook";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$email = '';
$password = '';


//store in session
session_start();

if (isset($_POST['submit'])) {

  $_SESSION['email'] = $_POST['email'];
  $_SESSION['password'] = $_POST['password'];

  $email = $_POST['email'];
  $password = $_POST['password'];



  $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {


    header("Location: list.php");

    exit;
  } else {
    // echo "Email or password is incorrect. Please try again.";
    echo '<script>alert("Invaild emailId or Password ")</script>';
  }


  mysqli_close($conn);
}


?>