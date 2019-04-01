<?php
//include connection file 
include_once("../connect/db_cls_connect.php");
$params = $_REQUEST;
$action = $params['action'] !='' ? $params['action'] : '';

switch($action) {
 case 'login':
	login($link);
 break;
 case 'logout':
	logout();
 break;
 default:
 return;
}

	function login($link) {
		if(isset($_POST['login-submit']) && isset($_POST['csrf_token'])){
			if($_SESSION['csrf_token'] === $_POST['csrf_token']){
			//Comparing both submitted values token and session token.
			$user_name = $_POST['username'];
			$user_password = $_POST['password'];
			$handle = $link->prepare('select id, username, password, role from users where username = :username');
			$handle->bindValue(':username', $user_name, PDO::PARAM_STR);
			$handle->execute();
			$row = $handle->fetch(PDO::FETCH_ASSOC);
			
			if(md5($user_password) == $row['password']){
				echo "1";
				$_SESSION['user_session'] = $row['username'];
			}
			if($row['role'] == 1){
				$_SESSION['isadmin'] = $row['role'];
			}
		}
		}
	}
	function logout() {
		unset($_SESSION['user_session'], $_SESSION['isadmin'], $_SESSION['csrf_token']);
		if(!isset($_SESSION['user_session']) && !isset($_SESSION['csrf_token'])) {
			header("Location: ../index.php");
		}
	}
?>