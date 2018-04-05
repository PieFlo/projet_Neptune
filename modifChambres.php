<?php 
session_start();
include('connectionBDD.php');
/*
if(isset($_POST['submit'])){
	$prenom = htmlspecialchars(trim($_POST['prenom'])); // trim permet d'enlever les espaces du début et de la fin dans la case 'prenom'.

	if(empty($prenom)){
		echo "Veuillez completez ce champ";
	}else{
		$query = $bdd->prepare("UPDATE clients SET prenom = '$prenom' WHERE prenom = '{$_SESSION['prenom']}'") or die('Erreur : ' . $e->getMessage());
		// or die('Erreur : ' . $e->getMessage()); // Pour afficher l'erreur s'il y en a une.
		$query->execute(); // Exécute la requette $query.

		header("Location:logout.php");
	}
}*/
?>
<!--
<form method="post">
	<p>Modification de votre prénom</p>
		<input type="text" name="prenom">
	<br><br>
		<input type="submit" name="submit" value="modifier">
</form>
-->