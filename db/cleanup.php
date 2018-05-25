<?php

include("./mysql_credentials.php");

$conn = new mysqli($host, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

// Create database
$sql = "DROP DATABASE $db_name";
if ($conn->query($sql) === TRUE) {
  echo "Database dopped";
} else {
  echo "Error dropping database: " . $conn->error;
}

$conn->close();



?>