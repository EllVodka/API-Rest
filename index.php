<?php
header('Content-Type: application/json');

include "connexion.php";

$requete = $pdo->prepare("SELECT praticien.nom , praticien.prenom , praticien.id_ville, type_praticien.libelle AS specialite FROM praticien LEFT JOIN type_praticien ON praticien.code_type_praticien = type_praticien.code LEFT JOIN ville ON praticien.id_ville = ville.id INNER JOIN departement ON ville.id_departement = departement.id WHERE praticien.id_ville LIKE '%:ville%' AND praticien.code_type_praticien LIKE '%:code%' AND departement.id LIKE '%:departement%';");
$requete->bindParam(':ville',$_POST["id_ville"]);
$requete->bindParam(':code',$_POST["code_type_praticien"]);
$requete->bindParam(':departement',$_POST["id"]);
$requete->execute();

$resultats = $requete->fetchAll();

$retour["success"] = true;
$retour["message"] = "Voici les infos sur les praticien";
$retour["results"]["nb"] = count($resultats);
$retour["results"]["praticien"] = $resultats;


echo json_encode($retour);

?>