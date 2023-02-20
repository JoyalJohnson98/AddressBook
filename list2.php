<!DOCTYPE html>
<html>
  <head>
    <style>
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }
      td,
  th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #dddddd;
  }

  .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #333;
    color: #fff;
  }

  .header a {
    color: #fff;
    text-decoration: none;
    margin-right: 10px;
  }

  .header button {
    background-color: #fff;
    color: #333;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
  }

  #address_table {
    display: none;
  }
</style>
</head>
  <body>
    <div class="header">
      <a href="add.php">+ Add User</a>
      <a href="list.php?logout=true">Logout</a>
    </div>
    <button id="show_address">Show Address </button>

<table id="address_table">
  <tr>
    <th>Name</th>
    <th>Phone</th>
    <th>State</th>
    <th>Country</th>
    <th>Photo</th>
    <th>Pincode</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>

  <?php
session_start();
if (!isset($_SESSION['email'])) 
{


  header("Location: login.php");
}
if (isset($_GET['logout'])) 
{

  session_destroy();
  header("Location: login.php");
}



$email = '';
$password = '';
$id = 0;



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


$email = $_SESSION['email'];

$password = $_SESSION['password'];

$sql = "SELECT id FROM user WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0)
{

  $row = $result->fetch_assoc();
  $id = $row["id"];
 

}

else {
  echo "0 results";
}


$sql = "SELECT id,name, phone, state, country, photo, pincode FROM address";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row["name"] . "</td>";
      echo "<td>" . $row["phone"] . "</td>";
      echo "<td>" . $row["state"] . "</td>";
      echo "<td>" . $row["country"] . "</td>";
      echo "<td><img src='" . $row["photo"] . "' height='50' width='50'></td>";
      echo "<td>" . $row["pincode"] . "</td>";
      echo "<td><a href='update.php?id=" . $row['id'] . "'>Edit</a></td>";
      echo "<td><a href='delete.php?id=" . $row['id'] . "' onClick='return confirm(\"Are you sure you want to delete?\")'>Delete</a></td>";
      
      echo "</tr>";
    }
  } else {
    echo "0 results";
  }
  $conn->close();

?>

</table>

<script>
  document.getElementById("show_address").addEventListener("click", function() {
    document.getElementById("address_table").style.display = "block";
  });
</script>
</body>

</html>
