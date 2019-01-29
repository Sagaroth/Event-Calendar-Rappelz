<?php

// Connexion a la base
require_once('bdd.php');

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['organisateur']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = $_POST['title'];
	$description = $_POST['description'];
	$organisateur = $_POST['organisateur'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	
	$title = addslashes($title);
	$description = addslashes($description);
	$organisateur = addslashes($organisateur);
	$start = addslashes($start);
	$end = addslashes($end);
	$color = addslashes($color);
	
	$sql = "INSERT INTO events(title, description, organisateur, start, end, color) values ('$title', '$description', '$organisateur', '$start', '$end', '$color')";
	
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
