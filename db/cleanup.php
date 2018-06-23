<?php

include("./mysql_credentials.php");

$conn = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "DROP DATABASE $mysql_db";
if ($conn->query($sql) === TRUE) {
  echo "Database dopped";
} else {
  echo "Error dropping database: " . $conn->error;
}

$conn->close();



?>