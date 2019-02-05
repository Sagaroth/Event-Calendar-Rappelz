<?php

// Connexion a la base
require_once('bdd.php');

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
	
	$sql = "INSERT INTO events(title, description, organisateur, orgaavailable, donator, start, end, color) values ('$title', '$description', '$organisateur', '$orgaavailable', '$donator', '$start', '$end', '$color')";
	
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
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
