<?php

// Create db
echo "Creating db<br/>";
include("./create_db.php");



// Users
echo "<br/>Creating users table<br/>";
include("./users/create_table.php");
echo "Seeding users table<br/>";
include("./users/seed_table.php");



?>