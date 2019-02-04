<?php
include_once("db_connect.php");
if(isset($_POST['btn-save'])) {
	$user_name = $_POST['user_name'];
	$user_name = addslashes($user_name);
	$user_name = htmlspecialchars($user_name);
	$user_server = $_POST['user_server'];
	$user_server = addslashes($user_server);
	$user_server = htmlspecialchars($user_server);
	$sql = "SELECT user FROM users WHERE user='$user_name'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);		
	if(!$row['user']){	
		$sql = "INSERT INTO users(`uid`, `user`, `server`) VALUES (NULL, '$user_name', '$user_server')";
		mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn)."qqq".$sql);			
		echo "registered";
	} else {				
		echo "1";	 
	}
}
?>