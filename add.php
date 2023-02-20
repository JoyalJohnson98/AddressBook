<?php

session_start();

$email = '';
$password = '';
$id = 0;
if (!isset($_SESSION['email'])) {


  header("Location: login.php");
}


//localhost details

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


$email = $_SESSION['email'];

$password = $_SESSION['password'];

$sql = "SELECT id FROM user WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $id = $row["id"];
} else {
  echo "No matching record found.";
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = $_POST["name"];
  $phone = $_POST["phone"];
  $state = $_POST["state"];
  $country = $_POST["country"];
  $photo = $_FILES["photo"]["name"];
  $pincode = $_POST["pincode"];


  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["photo"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $extensions_arr = array("jpg", "jpeg", "png", "gif");
  move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

  if (!preg_match('/^[\p{L} ]+$/u', $name)) {
    $name_error = "Name must contain only letters";
    $is_valid = false;
  }

  if (!preg_match("/^[0-9]{10}$/", $phone)) {
    $phone_error = "Mobile must  contain 10 digits";
    $is_valid = false;
  }

  if (!preg_match('/^[\p{L} ]+$/u', $state)) {
    $state_error = "State must contain only letters";
    $is_valid = false;
  }

  if (!preg_match('/^[\p{L} ]+$/u', $country)) {
    $country_error = "Country must contain only letters";
    $is_valid = false;
  }

  if (!preg_match("/^[1-9][0-9]{5}$/", $pincode)) {
    $pincode_error = "Invalid pin code";
    $is_valid = false;
  }




  if ($is_valid) {


    $sql = "INSERT INTO address (name, phone, state, country, photo, pincode,user_id)
VALUES ('$name', '$phone', '$state', '$country', '$photo', '$pincode','$id')";

    if ($conn->query($sql) === TRUE) {
      echo '<script>alert("Added new contact successfully ");
  location.href = "list.php";
  </script>';
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
}

?>


<html>

<head>
  <style>
    .error {
      color: red;
    }

    body {
      background-color: red;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }



    form {
      width: 500px;
      margin: 40px 0 0 350;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background-color: white;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      margin-bottom: 20px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 5px;
    }


    input[type="submit"] {
      width: 100%;
      padding: 12px 20px;
      margin-top: 20px;
      background-color: black;
      color: red;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: red;
      color: white;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <div class="top" style="background-color:black;height:13vh;width:100vw;display:flex;justify-content:center;">
      <h1 style="color:red;">Address Book</h1>
      <div style="position:absolute;top:30px;right:40px;font-size:12pt;">
        <a href="list.php" style="text-decoration:none;color:red;margin-right:7px;">Profile</a>
        <a href="index.php" style="text-decoration:none;color:red;">Home</a>
      </div>

    </div>
    <form action="" method="post" enctype="multipart/form-data">
      <label for="name" style="color: red">Name:</label>
      <input type="text" id="name" name="name">
      <span class="error"><?php echo $name_error; ?></span><br><br>


      <label for="phone" style="color: red">Phone:</label>
      <input type="number" id="phone" name="phone">
      <span class="error"><?php echo $phone_error; ?></span><br><br>


      <label for="state" style="color: red">State:</label>
      <input type="text" id="state" name="state">
      <span class="error"><?php echo $state_error; ?></span><br><br>


      <label for="country" style="color: red">Country:</label>
      <input type="text" id="country" name="country">
      <span class="error"><?php echo $country_error; ?></span><br><br>


      <label for="photo" style="color: red">Upload Photo:</label>
      <input type="file" id="photo" name="photo" onchange="previewImage(event);">
      <img id="preview" style="max-width : 100px; "><br><br>

      <label for="pincode" style="color: red">Pincode:</label>
      <input type="number" id="pincode" name="pincode">
      <span class="error"><?php echo $pincode_error; ?></span><br><br>


      <input type="submit" name="submit" value="Submit">
      <a href="list.php" style="color:red;">Go back</a>
    </form>
    <script>
      function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('preview');
          output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);

      }
    </script>
</body>

</html>