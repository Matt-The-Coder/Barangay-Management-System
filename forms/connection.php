<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "citizenservices";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
if(mysqli_connect_error()){
  echo "Error: Unable to connect";
  echo "Message: .mysqli_connect_error";
}
