<meta charset="utf-8"> <!-- Permet de mettre des accents -->

<?php
include 'connexionBDD.php';

if(isset($_POST)&& count($_POST) > 0){ // Quand on presse le bouton 'submit' alors ...
    extract(array_map("htmlspecialchars", $_POST));

/*	if($civil&&$nom&&$prenom&&$adresse&&$codePostal&&$ville&&$pays&&$dateNaissance&&$email&&$password&&$repeatpassword){ // Si les 7 paramètres sont remplis ...
		if(strlen($prenom)>=1){ // Si le nom d'utilisateur est supérieur à 4 caractères alors ne rien faire.
			if(strlen($password)>=6){ // Le mot de passe doit contenir plus de 6 caractères.
				if($password==$repeatpassword){
*/
                    $bdd = getDataBase();
                    $resultat = $bdd->query('SELECT MAX(numeroClient) AS max FROM clients');
                    $donnees = $resultat->fetch();
                    $newNum = intval($donnees["max"]) +1;
                    $nbInsert = 0;

                    try
                    {
                        $stmt = $bdd->prepare('INSERT INTO clients(numeroClient,civil,nom,prenom,adresse,codePostal,ville,pays,dateNaissance,email,password, admin) VALUES (:numeroClient, :civil, :nom, :prenom, :adresse, :codePostal, :ville, :pays, :dateNaissance, :email, :password, 0)');
                        $stmt->bindParam(':pNumeroClient', $newNum);
                        $stmt->bindParam(':pCivil', $civil);
                        $stmt->bindParam(':pNom', $nom);
                        $stmt->bindParam(':pPrenom', $prenom);
                        $stmt->bindParam(':pAdresse', $adresse);
                        $stmt->bindParam(':pCodePostal', $ville);
                        $stmt->bindParam(':pVille', $ville);
                        $stmt->bindParam(':pPays', $pays);
                        $stmt->bindParam(':pDateNaissance', $dateNaissance);
                        $stmt->bindParam(':pEmail', $email);
                        $stmt->bindParam(':pPassword', $password);

                    }
                    catch (Exception $e)
                    {
                        $nbInsert = 0;
                    }
                    echo "Enregistrement réussi !";

					//die('Inscription terminée, vous pouvez vous <a href="login.php">connecter</a>'); // Permet de tuer/arrêter la page.
/*
				}else echo "Les mots de passe ne sont pas identiques !";
			}else echo "Le mot de passe est trop court !";
		}else echo "Le nom d'utilisateur est trop court !"; // Si le nom d'utilisateur est inférieur à 4 caractères alros afficher ...
	}else echo "Veuillez saisir tous les champs !"; // Si les 3 paramètres ne sont pas remplis alors afficher ...
*/
}
?>

<title>Inscription</title> <!-- Titre -->

<center> <!-- Permet de centrer tout le formulaire d'inscription -->
	<h1>Inscription</h1> <!-- Afficher 'Inscription' en grand -->

	<form method="post" action="register.php"> <!-- Formulaire d'inscription en HTML -->
		<p>Nom</p>
			<input type="text" name="nom"/>
		<p>Prénom</p>
			<input type="text" name="prenom"/>
		<p>Adresse</p>
			<input type="text" name="adresse"/>
		<p>ville</p>
			<input type="text" name="ville"/>
		<p>Civil</p>
			<input type="text" name="civil"/>
		<p>Code postal</p>
			<input type="text" name="codePostal"/>
		<p>Pays</p>
			<input type="text" name="pays"/>
		<p>dateNaissance</p>
			<input type="text" name="dateNaissance" placeholder="AAAA-MM-JJ" />
		<p>Email</p>
			<input type="text" name="email"/>
		<p>Mot de passe</p>
			<input type="password" name="password"> <!-- Mot de passe -->
		<p>Confirmation du mot de passe</p>
			<input type="password" name="repeatpassword"/><br><br> <!-- Confirmation du mot de passe -->
			<input type="submit" name="submit" value="Enregistrer"/> <!-- Bouton permettant de s'enregistrer -->
	</form>
		<a href="login.php">Je possède déjà un compte</a>
</center>
<!-- civil
codePostal
pays
dateNaissance -->