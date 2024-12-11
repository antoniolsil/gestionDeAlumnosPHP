<?php
$servername = "localhost";
$username = "antoniols";
$password = "administrador";
$db = "db_iaw_als";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "The connection to the database could not be established: " . $e->getMessage();
}
?>