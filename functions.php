<?php
function getDataBase()
{
//    $host = "localhost";
//    $dbName = "neptune";
//    $login = "root";
//    $password = "";
    $host = "mysql.montpellier.epsi.fr";
    $dbName = "projet_neptune_pf";
    $login = "p.poujol";
    $password = "password";

    try{
        //$bdd = new PDO('mysql:host='.$host.';dbname='.$dbName.';charset=utf8', $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $bdd = new PDO('mysql:host='.$host.';port=5206;dbname='.$dbName.';charset=utf8', $login, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    catch (Exception $e){
        $bdd = null;
        die('Erreur : ' . $e->getMessage());
    }
    return $bdd;
}

function displayVar(){
    echo '<pre>';
    print_r($GLOBALS);
    echo '</pre>';
}

?>