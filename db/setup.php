<?php

// Create db
echo "Creating db<br/>";
include("./create_db.php");

// Users
echo "<br/>Creating users table<br/>";
include("./users/create_table.php");
echo "Seeding users table<br/>";
include("./users/seed_table.php");

// Plannings
echo "<br/>Creating plannings table<br/>";
include("./plannings/create_table.php");
echo "Seeding plannings table<br/>";
include("./plannings/seed_table.php");

// Messages
echo "<br/>Creating messages table<br/>";
include("./messages/create_table.php");
echo "Seeding messages table<br/>";
include("./messages/seed_table.php");

// trip_types
echo "<br/>Creating trip_types table<br/>";
include("./trip_types/create_table.php");
echo "Seeding trip_types table<br/>";
include("./trip_types/seed_table.php");

// Stages
echo "<br/>Creating stages table<br/>";
include("./stages/create_table.php");
echo "Seeding stages table<br/>";
include("./stages/seed_table.php");

// plannings_stages
echo "<br/>Creating plannings_stages table<br/>";
include("./plannings_stages/create_table.php");
echo "Seeding plannings_stages table<br/>";
include("./plannings_stages/seed_table.php");

// ratings
echo "<br/>Creating ratings table<br/>";
include("./ratings/create_table.php");
echo "Seeding ratings table<br/>";
include("./ratings/seed_table.php");

// users_plannings
echo "<br/>Creating users_plannings table<br/>";
include("./users_plannings/create_table.php");
echo "Seeding users_plannings table<br/>";
include("./users_plannings/seed_table.php");




?>