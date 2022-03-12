<?php
include "template.php";

//Création d'une parti de la requete preparé
$sql = "SELECT praticien.nom , praticien.prenom , praticien.id_ville, type_praticien.libelle AS specialite FROM praticien LEFT JOIN type_praticien ON praticien.code_type_praticien = type_praticien.code LEFT JOIN ville ON praticien.id_ville = ville.id INNER JOIN departement ON ville.id_departement = departement.id";

if(isset($_POST['ville']) || isset($_POST['code']) || isset($_POST['departement']))
{
    $sql .= " WHERE "; 

    if(isset($_POST['ville']) && isset($_POST['code']) && isset($_POST['departement']))
    {//Si tout est la 
        $sql.="praticien.id_ville LIKE :ville AND praticien.code_type_praticien LIKE :code AND departement.id LIKE :departement;";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':ville',$_POST["ville"]);
        $requete->bindParam(':code',$_POST["code"]);
        $requete->bindParam(':departement',$_POST["departement"]);
    }
    if(isset($_POST['ville']) && isset($_POST['code']) && empty($_POST['departement'])){
        //Si ville et code son rempli
        $sql.="praticien.id_ville LIKE :ville AND praticien.code_type_praticien LIKE :code; ";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':ville',$_POST["ville"]);
        $requete->bindParam(':code',$_POST["code"]);
    }
    if(isset($_POST['ville']) && empty($_POST['code']) && isset($_POST['departement'])){
        //Si ville et departement
        $sql.="praticien.id_ville LIKE :ville AND departement.id LIKE :departement;";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':ville',$_POST["ville"]);
        $requete->bindParam(':departement',$_POST["departement"]);
    }
    if(empty($_POST['ville']) && isset($_POST['code']) && isset($_POST['departement'])){
        //Si code et departement est rempli
        $sql.="praticien.code_type_praticien LIKE :code AND departement.id LIKE :departement;";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':code',$_POST["code"]);
        $requete->bindParam(':departement',$_POST["departement"]);
    }
    if (isset($_POST['ville']) && empty($_POST['code']) && empty($_POST['departement'])){
        //Si que ville est rempli
        $sql.= "praticien.id_ville LIKE :ville; ";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':ville',$_POST["ville"]);
    }
    if (empty($_POST['ville']) && isset($_POST['code']) && empty($_POST['departement'])){
        //Si que code est rempli
        $sql.= "praticien.code_type_praticien LIKE :code; ";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':code',$_POST["code"]);
    }
    if (empty($_POST['ville']) && empty($_POST['code']) && isset($_POST['departement'])){
        //Si que departement est rempli
        $sql.= "departement.id LIKE :departement;";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':departement',$_POST["departement"]);
    }   
    
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