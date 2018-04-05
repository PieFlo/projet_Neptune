<?php
session_start();
include 'connexionBDD.php'; // Permet de se connecter à la base de données.

if(isset($_POST) && count($_POST) > 0){
    extract(array_map("htmlspecialchars", $_POST));

	$bdd = getDataBase();
	$login = $bdd->prepare("SELECT * FROM clients WHERE email=:email AND password=:password");
    $login->bindParam(':email', $email);
    $login->bindParam(':password', $password);
	$login->execute();
    $donnees = $login->fetch();

	if($donnees){
		$_SESSION['prenom'] = $donnees['prenom'];
		$_SESSION['admin'] = $donnees['admin'];
		$_SESSION['email'] = $donnees['email'];
        $_SESSION['numeroClient'] = $donnees['numeroClient'];
		header('Location:panel.php');
	}else{
        echo "Adresse email ou mot de passe incorrect !";
        session_destroy();
    }
}
?>
