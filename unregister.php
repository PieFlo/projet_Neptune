<?php
session_start();
include 'connexionBDD.php'; // Permet de se connecter à la base de données.
$bdd = getDataBase();

if($_SESSION['admin'] == true)
    $numeroClientToDelete = $_POST['numeroClient'];
else
    $numeroClientToDelete = $_SESSION['numeroClient'];

$query = $bdd->prepare("DELETE FROM clients WHERE numeroClient = :NumCli");// Permet de supprimer la session active.
$query->bindParam(':NumCli',$numeroClientToDelete);
$query->execute(); // Exécute la requette $query.
if($_SESSION['admin'] == true)
    header("Location:delClient.php?req=1");
else
    header("Location:logout.php"); // Une fois la suppression du compte terminée, l'utilisateur est redirigé vers la page 'logout' afin de fermée la session supprimé puis est redirigé vers la page de connection.

?>