<?php
/*  Rappelz Event Calendar  - Make events with players.
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
addEvent($link);

function addEvent($link) { //Create add event function.
	if(isSet($_SESSION['user_session'])){
	if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['organisateur']) && isset($_POST['orgaavailable']) && isset($_POST['donator']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$creationtime = date("Y-m-d H:i:s");
	$md5checksum = md5($creationtime);
	
	$_POST['organisateur'] = $_SESSION['user_session'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$organisateur = $_SESSION['user_session']; //Avoid organisator modification with browser console
	$orgaavailable = $_POST['orgaavailable'];
	$donator = $_POST['donator'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	
	$title = addslashes($title);
	$description = addslashes($description);
	$organisateur = addslashes($organisateur);
	$orgaavailable = addslashes($orgaavailable);
	$donator = addslashes($donator);
	$title = htmlspecialchars($title);
	$description = htmlspecialchars($description);
	$description = str_replace(["\r\n", "\r", "\n"], "<br/>", $description);
	$organisateur = htmlspecialchars($organisateur);
	$orgaavailable = htmlspecialchars($orgaavailable);
	$donator = htmlspecialchars($donator);
	$start = addslashes($start);
	$end = addslashes($end);
	$color = addslashes($color);
	
	if (strlen($title) >= 6 && strlen($title) <= 60 && strlen($description) <= 5000 && strlen($organisateur) >= 4 && strlen($organisateur) <= 20 && strlen($orgaavailable) <= 20 && strlen($donator) <= 20){	
		$handle = $link->prepare('INSERT INTO events (id, title, description, organisateur, orgaavailable, donator, start, end, color, creation_time, md5_checksum) VALUES (:id, :title, :description, :organisateur, :orgaavailable, :donator, :start, :end, :color, :creation_time, :md5checksum)');
		$handle->bindValue(':id', NULL, PDO::PARAM_NULL);
		$handle->bindValue(':title', $title, PDO::PARAM_STR);
		$handle->bindValue(':description', $description, PDO::PARAM_STR);
		$handle->bindValue(':organisateur', $organisateur, PDO::PARAM_STR);
		$handle->bindValue(':orgaavailable', $orgaavailable, PDO::PARAM_STR);
		$handle->bindValue(':donator', $donator, PDO::PARAM_STR);
		$handle->bindValue(':start', $start, PDO::PARAM_STR);
		$handle->bindValue(':end', $end, PDO::PARAM_STR);
		$handle->bindValue(':color', $color, PDO::PARAM_STR);		
		$handle->bindValue(':creation_time', $creationtime, PDO::PARAM_STR);		
		$handle->bindValue(':md5checksum', $md5checksum, PDO::PARAM_STR);		
		$handle->execute();
	}
	else {
	return false;
	}

}

if(!empty($_FILES)){     
    $uploadDir = "../uploads/";
    $fileName = $_FILES['file']['name'];
    $uploadedFile = $uploadDir.$fileName;    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadedFile)) {
        $mysqlInsert = "INSERT INTO uploads (file_name, upload_time, md5_checksum)VALUES('".$fileName."','$creationtime', '$md5checksum')";
		mysqli_query($conn, $mysqlInsert);
    }   
}
}
}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
