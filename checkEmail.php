<?php
include('db/mysql_credentials.php');

// Stampa "ok" se la mail non è presente e "ko" se la mail esiste già
// Se lo script ha dei problemi risponde con ok

if(!isset($_GET['email']))
	echo "ok";

$to_check = $_GET['email'];

$mysqli = new mysqli($mysql_server, $mysql_user, $mysql_pass, $mysql_db);

/* check connection */
if (mysqli_connect_errno()) {
		echo "ok";
}

$query="SELECT * FROM users";

$result=$mysqli->query($query)
	or die ($mysqli->error);

$emails = array();
for($i=0; $row=$result->fetch_assoc(); $i++)
	$emails[$i]=$row['email'];

$mysqli->close();

if(in_array($to_check, $emails))
	echo "ko";
else
	echo "ok";
?>
