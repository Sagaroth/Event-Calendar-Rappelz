<?php
include_once("db_connect.php");
if(isset($_POST['btn-save'])) {
	$user_name = $_POST['user_name'];
	$user_server = $_POST['user_server'];
	/*$user_email = $_POST['user_email'];
	$user_password = $_POST['password'];*/
	$sql = "SELECT user FROM users WHERE user='$user_name'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);		
	if(!$row['user']){	
		//$sql = "INSERT INTO users(`uid`, `user`, `server`, `pass`, `email`, `profile_photo`) VALUES (NULL, '$user_name', '$user_server', '$user_password', '$user_email', NULL)";
		$sql = "INSERT INTO users(`uid`, `user`, `server`) VALUES (NULL, '$user_name', '$user_server')";
		mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn)."qqq".$sql);			
		echo "registered";
	} else {				
		echo "1";	 
	}
}
?>