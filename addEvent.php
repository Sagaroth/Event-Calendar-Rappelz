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
    along with this program.  If not, see <https://www.gnu.org/licenses/>. -->*/
	
// Connexion a la base


require_once('bdd.php');
include_once("db_connect.php");

$creationtime = date("Y-m-d H:i:s");
$md5checksum = md5($creationtime);

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['organisateur']) && isset($_POST['orgaavailable']) && isset($_POST['donator']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = $_POST['title'];
	$description = $_POST['description'];
	$organisateur = $_POST['organisateur'];
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
	
	$sql = "INSERT INTO events(title, description, organisateur, orgaavailable, donator, start, end, color, creation_time, md5_checksum) values ('$title', '$description', '$organisateur', '$orgaavailable', '$donator', '$start', '$end', '$color', '$creationtime', '$md5checksum')";
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}

if(!empty($_FILES)){     
    $uploadDir = "uploads/";
    $fileName = $_FILES['file']['name'];
	$fileName = 'test'.$fileName;
    $uploadedFile = $uploadDir.$fileName;    
    if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadedFile)) {
        $mysqlInsert = "INSERT INTO uploads (file_name, upload_time, md5_checksum)VALUES('".$fileName."','$creationtime', '$md5checksum')";
		mysqli_query($conn, $mysqlInsert);
    }   
}

header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
