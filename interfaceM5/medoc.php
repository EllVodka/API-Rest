<?php

try{
	$pdo = new PDO('mysql:host=localhost;dbname=mission3',"root","");
}
catch (Exception $e) {
	print($e->getMessage());
}

$sqlMedoc = "SELECT * FROM medicaments";
$sqlTypeMedox = "SELECT * FROM typemedicaments";

$requeteMedoc = $pdo->prepare($sqlMedoc);
$requeteTypeMedoc = $pdo->prepare($sqlTypeMedox);

if($requeteMedoc->execute()){
    $resultatMedoc = $requeteMedoc->fetchAll();
}
if($requeteTypeMedoc->execute()){
    $resultatTypeMedoc = $requeteTypeMedoc->fetchAll();
}

//var_dump($resultatMedoc)
?>

<table border="1px">
    <tr>
        <th>Nom Produit</th>
        <th>Description</th>
        <th>Prix</th>
        <th>Type Medicament</th>
</tr>
<?php
    for($i=0;$i<count($resultatMedoc);$i++){
    echo "<tr>";
        echo "<td>".$resultatMedoc[$i]["NomProduit"]."</td>";
        echo "<td >".$resultatMedoc[$i]["Description"]."</td>";
        echo "<td>".$resultatMedoc[$i]['Prix']." €"."</td>";
        echo "<td>".$resultatMedoc[$i]['TypeMedicament']."</td>";

    echo "</tr>";
    }
    ?>     
 </table>

 <table border="1px">
    <tr>
        <th>Code Medicament</th>
        <th>Designation</th>

</tr>
<?php
    for($i=0;$i<count($resultatTypeMedoc);$i++){
    echo "<tr>";
        echo "<td>".$resultatTypeMedoc[$i]["Libelle"]."</td>";
        echo "<td>".$resultatTypeMedoc[$i]['Designation']."<td>";
    echo "</tr>";
    }
    ?>     
 </table>