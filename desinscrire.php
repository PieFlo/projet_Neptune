<?php
session_start();
include 'connectionBDD.php'; // Permet de se connecter à la base de données.

//mysql_query("DELETE FROM clients WHERE prenom = '{$_SESSION['prenom']'");
$query = $bdd->prepare("DELETE FROM clients WHERE email = '{$_SESSION['email']}'"); // Permet de supprimer la session active.
$query->execute(); // Exécute la requette $query.
header("Location:logout.php"); // Une fois la suppression du compte terminée, l'utilisateur est redirigé vers la page 'logout' afin de fermée la session supprimé puis est redirigé vers la page de connection.

?>