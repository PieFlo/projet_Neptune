<?php
session_start();
include_once('header.html');
include_once('functions.php'); // Permet de se connecter à la base de données.

if(isset($_SESSION['email'])){
    if(isset($_SERVER['HTTP_REFERER'])){
        If ($_SERVER['HTTP_REFERER'] == "http://".$_SERVER['HTTP_HOST'].$_SERVER['CONTEXT_PREFIX']."/index.php"
            || $_SERVER['HTTP_REFERER'] == "http://".$_SERVER['HTTP_HOST'].$_SERVER['CONTEXT_PREFIX']) {
            echo "<div class=\"alert alert-success\">Bienvenue ".$_SESSION['prenom']." !</div>";
        }
    }

?>
<h1>Tableau de bord</h1><br>
    <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">L'Hôtel</div>
        <div class="panel-body">
            <a href="listeChambre.php">Effectuer une réservation</a><br>
<?php       if ($_SESSION['admin']==true) { ?>
            <a href="listeClient.php">Liste des clients</a><br>
<?php       } ?>
            <a href="reservation.php">Ma réservation</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Profil</div>
        <div class="panel-body">
            <a href="updateClient.php">Modifier ses informations</a><br>
            <a href="updateClientMdp.php">Modifier son mot de passe</a><br>
            <a data-toggle="modal" href="#unregister" class="button">Se désinscrire</a>
            <div class="modal fade" id="unregister" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Déinscription</h4>
                        </div>
                        <div class="modal-body">
<?php       if ($_SESSION['admin']==false) { ?>
                            <p>Êtes-vous sûr de vouloir vous déinscrire ?</p>
                        </div>
<?php       } else { echo "<p>L'administrateur ne peut pas se désinscrire</p>";} ?>
                        <div class="modal-footer">
<?php       if ($_SESSION['admin']==false) { ?>
                            <a href="unregister.php"><button type="button" class="btn btn-danger">Oui</button></a>
<?php       } ?>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
<?php if ($_SESSION['admin']==false) echo "Non"; else echo "Fermer";?></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
<br>
<br>
<?php

}else{
	header('Location:logout.php'); // permet de ne pas pouvoir acceder à la page directement en modifiant l'URL. Il faut obligatoirement s'inscrire.
}
//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';
include_once('footer.html');
?>
