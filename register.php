<!--	<Rappelz Event Calendar  - Make events with players.>
    Copyright (C) <2019>  <History of Rappelz>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>. -->

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