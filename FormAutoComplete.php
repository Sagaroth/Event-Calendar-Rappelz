<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendar";
	$mysqli = new mysqli($servername, $username, $password, $dbname);


	/*$sql = "SELECT user, server FROM users 
			WHERE user LIKE '%".$_GET['query']."%'
			LIMIT 10"; 
	$result = $mysqli->query($sql);
	

	$jsonuser = [];
	while($row = $result->fetch_assoc()){
	     $jsonuser[] = $row['user'];
	}

	echo json_encode($jsonuser);*/
	
	$sql = "SELECT Concat(user, ' - ', server) AS fulldetail FROM users 
			WHERE user LIKE '%".$_GET['query']."%'
			LIMIT 15"; 
	$result = $mysqli->query($sql);
	

	$jsonuser = [];
	while($row = $result->fetch_assoc()){
	$jsonuser[] = $row['fulldetail'];
	}

	echo json_encode($jsonuser);