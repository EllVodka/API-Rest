<?php

header('Content-Type: application/json');

try{
	$pdo = new PDO('mysql:host=localhost;dbname=gsb_practicien',"root","");
}
catch (Exception $e) {
	$retour["success"] = false;
	$retour["message"] = "Connexion a la base de données echoué";
}

?>