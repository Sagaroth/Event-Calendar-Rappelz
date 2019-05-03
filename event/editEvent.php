<?php
/*	Rappelz Event Calendar  - Make events with players.>
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
    along with this program.  If not, see <https://www.gnu.org/licenses/>*/
	
// Connexion a la base
include_once("../connect/db_cls_connect.php"); //Include connection file.
editEvent($link);

function editEvent($link) { //Create edit event function.
	if (isSet($_SESSION['user_session'])){
	if (strcasecmp($_SESSION['user_session'], $_POST['organisateur']) == 0 || isSet($_SESSION['isadmin'])){
	if (isset($_POST['delete']) && isset($_POST['id'])){
		
	$id = $_POST['id'];
		$handle = $link->prepare('DELETE FROM events WHERE id = :id');
		$handle->bindValue(':id', $id, PDO::PARAM_INT);	
		$handle->execute();
	}elseif (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['organisateur']) && isset($_POST['orgaavailable'])&& isset($_POST['donator']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$organisateur = $_POST['organisateur'];
	$orgaavailable = $_POST['orgaavailable'];
	$donator = $_POST['donator'];
		
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
	$color = $_POST['color'];
	
	if (strlen($title) >= 6 && strlen($title) <= 60 && strlen($description) <= 5000 && strlen($organisateur) >= 4 && strlen($organisateur) <= 20 && strlen($orgaavailable) <= 20 && strlen($donator) <= 20){	
		$handle = $link->prepare('UPDATE events SET title = :title, description = :description, organisateur = :organisateur, orgaavailable = :orgaavailable, donator = :donator, color = :color WHERE id = :id');
		$handle->bindValue(':id', $id, PDO::PARAM_INT);
		$handle->bindValue(':title', $title, PDO::PARAM_STR);
		$handle->bindValue(':description', $description, PDO::PARAM_STR);
		$handle->bindValue(':organisateur', $organisateur, PDO::PARAM_STR);
		$handle->bindValue(':orgaavailable', $orgaavailable, PDO::PARAM_STR);
		$handle->bindValue(':donator', $donator, PDO::PARAM_STR);
		$handle->bindValue(':color', $color, PDO::PARAM_STR);		
		$handle->execute();
	}
	else {
	return false;
	}
	
}
}
}
}
header('Location: ../index.php');
?>
