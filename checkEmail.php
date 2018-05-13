<?php
//Stampa "ok" se la mail non è presente e "ko" se la mail esiste già
if(!isset($_GET['email']))
	header('Location: error.html');

$to_check = $_GET['email'];

$mysqli = new mysqli("localhost", "S4166252", "]-vqPx]QhpU4tn", "S4166252");

/* check connection */
if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
}

$query="SELECT * FROM users";

$result=$mysqli->query($query)
	or die ($mysqli->error);

//the array that will hold the emails
$emails = array();
for($i=0; $row=$result->fetch_assoc(); $i++)//mysql_fetch_array($sql)
	$emails[$i]=$row['email'];

$mysqli->close();

if(in_array($to_check, $emails))
	echo "ko";
else
	echo "ok";
?>
