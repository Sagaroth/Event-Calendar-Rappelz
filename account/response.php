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
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
include_once("../connect/db_cls_connect.php"); //Include connection file.
$params = $_REQUEST;
$action = $params['action'] !='' ? $params['action'] : '';

switch($action) {
 case 'login':
	login($link); //Call the login function with $link (from db_cls_connect.php) in parameter.
 break;
 case 'logout':
	logout(); //Call the logout function.
 break;
 default:
 return;
}

	function login($link) { //Create login function.
		if(isset($_POST['login-submit']) && isset($_POST['csrf_token'])){ //Check form and token submit.
		if($_SESSION['csrf_token'] != $_POST['csrf_token']){
			echo "0";
		}
		else if($_SESSION['csrf_token'] === $_POST['csrf_token']){ //Comparing both submitted values token and session token.
			$user_name = $_POST['username'];
			$user_password = $_POST['password'];
			$handle = $link->prepare('select id, username, password, role from users where username = :username');
			$handle->bindValue(':username', $user_name, PDO::PARAM_STR);
			$handle->execute();
			$row = $handle->fetch(PDO::FETCH_ASSOC);			
			if(password_verify($user_password, $row['password'])) { //Check password validity with hash.
				echo "1";
				$_SESSION['user_session'] = $row['username'];
			}
			if($row['role'] == 1){ //Check if user is admin
				$_SESSION['isadmin'] = $row['role']; //Store the admin statement in SESSION.
			}
		}
		}
	}
	function logout() { //Create logout function.
		unset($_SESSION['user_session'], $_SESSION['isadmin'], $_SESSION['csrf_token']); //Kill user, admin and token session.
		if(!isset($_SESSION['user_session']) && !isset($_SESSION['csrf_token'])) { //Check user and token session deletion.
			header("Location: ../index.php");
		}
	}
?>