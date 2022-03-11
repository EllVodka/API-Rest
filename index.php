<?php
include "template.php";

//Création d'une parti de la requete preparé
$sql = "SELECT praticien.nom , praticien.prenom , praticien.id_ville, type_praticien.libelle AS specialite FROM praticien LEFT JOIN type_praticien ON praticien.code_type_praticien = type_praticien.code LEFT JOIN ville ON praticien.id_ville = ville.id INNER JOIN departement ON ville.id_departement = departement.id";

if(isset($_POST['ville']) && isset($_POST['code']) && isset($_POST['departement']))
{
    //Si le client a saisie la ville, le code praticien et le departement, on filtre les données via MYSQL
    $sql .= " WHERE praticien.id_ville LIKE :ville AND praticien.code_type_praticien LIKE :code AND departement.id LIKE :departement;";
    $requete = $pdo->prepare($sql);

    //ajout des paramètre 
    $requete->bindParam(':ville',$_POST["ville"]);
    $requete->bindParam(':code',$_POST["code"]);
    $requete->bindParam(':departement',$_POST["departement"]);    
}
else
{
    //fin de la requete
    $sql .= ";";
    $requete = $pdo->prepare($sql);
}

//Execution de la requete
if($requete->execute()){
    $resultats = $requete->fetchAll();

    $success = true;
    $data["nombre"] = count($resultats);
    $data["praticien"] = $resultats;
    $msg = " Voici les infos sur les praticien";
}else
{
    $msg = "Une erreur s'est produite";
}



reponse_json($success,$data,$msg)
?>