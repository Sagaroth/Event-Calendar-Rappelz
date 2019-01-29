<?php

// Connexion a la base
require_once('bdd.php');

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['organisateur']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = htmlspecialchars($_POST['title'], ENT_QUOTES);
	$description = htmlspecialchars($_POST['description'], ENT_QUOTES);
	$organisateur = htmlspecialchars($_POST['organisateur'], ENT_QUOTES);
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
		
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
