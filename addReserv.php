<?php
/**
 * Created by PhpStorm.
 * User: pfpou
 * Date: 13/06/2018
 * Time: 20:36
 */
session_start();
include_once('functions.php');
include_once('header.html');

$bdd = getDataBase();
$query = $bdd->query('SELECT * FROM reservations WHERE arrivee > NOW() OR depart > NOW()  AND numeroCLient ='.$_SESSION['numeroClient']);
$result = $query->rowCount();
if($result == 0){
    $stmt = $bdd->prepare("INSERT INTO reservations (numeroChambre, arrivee, depart, payee, numeroClient) VALUES (:numeroChambre, :arrivee, :depart, 0, :numeroClient)");
    $stmt->bindParam(':numeroChambre', $_POST['numeroChambre']);
    $stmt->bindParam(':arrivee', $_POST['arrivee']);
    $stmt->bindParam(':depart', $_POST['depart']);
    $stmt->bindParam(':numeroClient', $_SESSION['numeroClient']);
    $stmt->execute();
    if ($stmt = true)
        echo'<div class="alert alert-success">Votre réservation a bien été prise en compte.</div>';
} else
    echo'<div class="alert alert-info">Vous ne pouvez pas avoir plusieurs réservations à la fois.</div>';

include_once ('footer.html');
?>