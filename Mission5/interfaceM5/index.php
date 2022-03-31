<html>
<head>
<link href="style.css" rel="stylesheet">
</head>
<body>
<form method="POST">
    <img src="image/logo-gsb.png">
    <div class="table">
    <center><fieldset class="item">
    <label>Id ville</label>
    <input type="text" name="ville"><br><br>
    <label>Code du praticien</label>
    <input type="text" name="code"><br><br>
    <label>Departement du praticien</label>
    <input type="text" name="departement"><br><br>

    <input type="submit" name="Recherche" value="Recherche" >
    </fieldset></center>
</form>


<?php

$curl = curl_init();


if(isset($_POST['Recherche'])){
    if(isset($_POST['ville']) && isset($_POST['code']) && isset($_POST['departement']))
    {//Si tout est la 
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Mission5/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 200000,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('ville' => $_POST['ville'],'code' => $_POST['code'],'departement' => $_POST['departement']),
        ));
    }
    if(isset($_POST['ville']) && isset($_POST['code']) && empty($_POST['departement'])){
        //Si ville et code son rempli
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Mission5/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 200000,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('ville' => $_POST['ville'],'code' => $_POST['code']),
        ));
    }
    if(isset($_POST['ville']) && empty($_POST['code']) && isset($_POST['departement'])){
        //Si ville et departement son rempli
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Mission5/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 200000,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('ville' => $_POST['ville'],'departement' => $_POST['departement']),
        ));
    }
    if(empty($_POST['ville']) && isset($_POST['code']) && isset($_POST['departement'])){
        //Si code et departement est rempli
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Mission5/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 200000,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('code' => $_POST['code'],'departement' => $_POST['departement']),
        ));
    }
    if (isset($_POST['ville']) && empty($_POST['code']) && empty($_POST['departement'])){
        //Si que ville est rempli
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Mission5/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 200000,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('ville' => $_POST['ville']),
        ));
    }
    if (empty($_POST['ville']) && isset($_POST['code']) && empty($_POST['departement'])){
        //Si que code est rempli
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Mission5/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 200000,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('code' => $_POST['code']),
        ));
    }
    if (empty($_POST['ville']) && empty($_POST['code']) && isset($_POST['departement'])){
        //Si que departement est rempli
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/Mission5/index.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 200000,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('departement' => $_POST['departement']),
        ));
    } 
    $response = curl_exec($curl);

      curl_close($curl);
    $resultat = json_decode($response,true);
    ?><center>
        <p id="titres">Nombre de praticien : <?php echo $resultat['nombre'];?> </p>
        <br>
        <table id="table1">
    <tr id="tr1">
        <th>Nom Praticien</th>
        <th>Prenom Praticien</th>
        <th>Ville du Praticien</th>
        <th>Type de Praticien</th>
</tr>
<?php
    for($i=0;$i<$resultat['nombre'];$i++){
    echo "<tr id = 'tr2'>";
        echo "<td>".$resultat['praticien'][$i]['nom']."</td>";
        echo "<td>".$resultat['praticien'][$i]['prenom']."</td>";
        echo "<td>".$resultat['praticien'][$i]['id_ville']."</td>";
        echo "<td>".$resultat['praticien'][$i]['specialite']."</td>";

    echo "</tr>";
    }
}
    ?>     
 </table>
</center>
<br>
<center> <p class="medoc">Cliquer <a href="medoc.php">ici</a> pour voir les medicament</p></center>

</body>
</html>
