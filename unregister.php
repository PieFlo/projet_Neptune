<?php
session_start();
include 'connexionBDD.php'; // Permet de se connecter à la base de données.
$bdd = getDataBase();
$query = $bdd->prepare("DELETE FROM clients WHERE numeroClient = :sessionNumCli");// Permet de supprimer la session active.
$query->bindParam(':sessionNumCli',$_SESSION['numeroClient']);
$query->execute(); // Exécute la requette $query.
header("Location:logout.php"); // Une fois la suppression du compte terminée, l'utilisateur est redirigé vers la page 'logout' afin de fermée la session supprimé puis est redirigé vers la page de connection.

?>