<?php
include_once("db_connect.php");
if(isset($_POST['btn-save'])) {
	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['password'];	
	$sql = "SELECT email FROM users WHERE email='$user_email'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);		
	if(!$row['email']){	
		$sql = "INSERT INTO users(`uid`, `user`, `pass`, `email`, `profile_photo`) VALUES (NULL, '$user_name', '$user_password', '$user_email', NULL)";
		mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn)."qqq".$sql);			
		echo "registered";
	} else {				
		echo "1";	 
	}
}
?>