<?php
  include("./mysql_credentials.php");

  $conn = new mysqli($host, $db_user, $db_pass);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  // Create database
  $sql = "CREATE DATABASE $db_name";
  if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . $conn->error;
  }

  $conn->close();


?>