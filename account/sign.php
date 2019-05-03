<?php
/*  Rappelz Event Calendar  - Make events with players.>
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
    along with this program.  If not, see <https://www.gnu.org/licenses/>.*/
	
// Connexion a la base
include_once("../connect/db_cls_connect.php"); //Include connection file.

sign($link); //Call the sign function with $link (from db_cls_connect.php) in parameter.

	function sign($link) { //Create sign function.
		if(isset($_POST['btn-save']) && isset($_POST['csrf_token'])){ //Check form and token submit.
			if($_SESSION['csrf_token'] != $_POST['csrf_token']){
				echo "0";
			}
			else if($_SESSION['csrf_token'] === $_POST['csrf_token']){ //Comparing both submitted values token and session token.
			$identifier = $_POST['identifier'];
			$password = $_POST['password'];
			$password = password_hash($password, PASSWORD_DEFAULT); //Hash password with BCRYPT algorithm up to 255 characters.
			$creationtime = date("Y-m-d H:i:s"); //Use current date for inscription time.
			$handle = $link->prepare('select username from users where username = :username');
			$handle->bindValue(':username', $identifier, PDO::PARAM_STR);
			$handle->execute();
			$row = $handle->fetch(PDO::FETCH_ASSOC);		
			if(!$row['username']){
				$handle = $link->prepare('INSERT INTO users (id, username, password, role, creation_time) VALUES (:id, :username, :password, :role, :creation_time)');
				$handle->bindValue(':id', NULL, PDO::PARAM_NULL);
				$handle->bindValue(':username', $identifier, PDO::PARAM_STR);
				$handle->bindValue(':password', $password, PDO::PARAM_STR);
				$handle->bindValue(':role', 0, PDO::PARAM_BOOL);
				$handle->bindValue(':creation_time', $creationtime, PDO::PARAM_STR);		
				$handle->execute();
				echo "registered"; //Return registered for javascript OK confirmation.
			} else {				
				echo "1"; //Return 1 for javascript NOK confirmation.
			}
			}
		}
	}
?>