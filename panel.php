<?php
session_start();
include_once('header.html');
include 'connexionBDD.php'; // Permet de se connecter à la base de données.

if(isset($_SESSION['email'])){
    If ($_SERVER['HTTP_REFERER'] == "http://".$_SERVER['HTTP_HOST'].$_SERVER['CONTEXT_PREFIX']."/index.html"
        || $_SERVER['HTTP_REFERER'] == "http://".$_SERVER['HTTP_HOST'].$_SERVER['CONTEXT_PREFIX']) {
        echo "<div class=\"alert alert-success\">Bienvenue ".$_SESSION['prenom']." !</div>";
    }
?>


<h1>Tableau de bord</h1>
    <div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">Reservations</div>
        <div class="panel-body">
            <a href="chambres.php">Voir les chambres de l'hôtel</a><br>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Profil</div>
        <div class="panel-body">
            <a href="updateClient.php">Modifier ses informations</a><br>
            <a>Modifier son mot de passe</a><br>
            <a href="desinscrire.php">Se désinscrire</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Administration</div>
        <div class="panel-body">
            <p><a href="voirClients.php">Voir les clients de l'hôtel</a>. Admin uniquement !</p>
        </div>
    </div>
    </div>
<br>
<br>
<?php

}else{
	header('Location:index.html'); // permet de ne pas pouvoir acceder à la page directement en modifiant l'URL. Il faut obligatoirement s'inscrire.
}
echo '<pre>';
print_r($GLOBALS);
echo '</pre>';
include_once('footer.html');
?>