<?php
// Conexion a la base
require_once('bdd.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM events WHERE id = $id";
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	
}elseif (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['organisateur']) && isset($_POST['orgaavailable']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$organisateur = $_POST['organisateur'];
	$orgaavailable = $_POST['orgaavailable'];
		
	$title = addslashes($title);
	$description = addslashes($description);
	$organisateur = addslashes($organisateur);
	$orgaavailable = addslashes($orgaavailable);
	$title = htmlspecialchars($title);
	$description = htmlspecialchars($description);
	$description = str_replace(["\r\n", "\r", "\n"], "<br/>", $description);
	$organisateur = htmlspecialchars($organisateur);
	$orgaavailable = htmlspecialchars($orgaavailable);
	$color = $_POST['color'];
	
	$sql = "UPDATE events SET  title = '$title', description = '$description', organisateur = '$organisateur', orgaavailable = '$orgaavailable', color = '$color' WHERE id = $id ";
	
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
header('Location: index.php');

	
?>
