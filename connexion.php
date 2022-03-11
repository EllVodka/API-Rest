<?php
try{
	$pdo = new PDO('mysql:host=localhost;dbname=gsb_practicien',"root","");
	$retour["success"] = true;
	$retour["message"] = "Connexion a la base de données reussite";
}
catch (Exception $e) {
	$retour["success"] = false;
	$retour["message"] = "Connexion a la base de données echoué";
}

?>