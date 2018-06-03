<?php
include_once('header.html');
include_once ('functions.php');
if (isset($_POST['idReservation'])){
    if(strtotime(date("Y-m-d")) < strtotime($_POST["arrivee"])){
        $bdd = getDataBase();
        $stmt = $bdd->prepare("DELETE FROM reservations WHERE idReservation = :idReservation");
        $stmt->bindParam(':idReservation', $_POST['idReservation']);
        $stmt->execute();
        if ($stmt = true)
            echo'<div class="alert alert-success">La réservation a bien été annulée.</div>';
    } else
        echo '<div class="alert alert-danger">Vous ne pouvez pas annuler votre réservation à cette date.</div>';
} else header('Location:panel.php');
//displayVar();
include_once('footer.html');
?>
