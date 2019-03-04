<?php
/*<!--	<Rappelz Event Calendar  - Make events with players.>
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
*/
include_once("db_connect.php");
$creationtime = date("Y-m-d H:i:s");
if(isset($_POST['btn-save'])) {
	$identifier = $_POST['identifier'];
	$password = $_POST['password'];
	$password = md5($password);
	$sql = "SELECT username FROM users WHERE username='$identifier'";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
	$row = mysqli_fetch_assoc($resultset);		
	if(!$row['username']){	
		$sql = "INSERT INTO users(`id`, `username`, `password`, `creation_time`) VALUES (NULL, '$identifier', '$password', '$creationtime')";
		mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn)."qqq".$sql);			
		echo "registered";
	} else {				
		echo "1";	 
	}
}
?>