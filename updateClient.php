<?php
session_start();
include 'connexionBDD.php'; // Permet de se connecter à la base de données.

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
}
?>

<form method="post" action="register.php" class="form-horizontal">

        <div class="form-group">
            <label for="inputNom" class="control-label col-xs-4">Nom</label>
            <div class="col-xs-5">
                <input type="text" id="inputNom" name="nom" placeholder="Doe" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPrenom" class="control-label col-xs-4 col-form-label">Prénom</label>
            <div class="col-xs-5">
                <input type="text" id="inputPrenom" name="prenom" placeholder="John" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputCivil" class="control-label col-xs-4">Civilité</label>
            <div class="col-xs-5">
                <select id="inputCivil" name="civil" class="form-control" required>
                    <option value="Monsieur">Monsieur</option>
                    <option value="Madame">Madame</option>
                    <option value="Mademoiselle">Mademoiselle</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputDateNaissance" class="control-label col-xs-4">Date de naissance</label>
            <div class="col-xs-5">
                <input type="date" id="inputDateNaissance" name="dateNaissance" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAdresse" class="control-label col-xs-4">Adresse</label>
            <div class="col-xs-5">
                <input type="text" id="inputAdresse" name="adresse" placeholder="19 Rue Turgot"
                       class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputCodePostal" class="control-label col-xs-4">Code postal</label>
            <div class="col-xs-5">
                <input type="text" id="inputCodePostal" name="codePostal" placeholder="75009"
                       class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputVille" class="control-label col-xs-4">Ville</label>
            <div class="col-xs-5">
                <input type="text" id="inputVille" name="ville" placeholder="Paris" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPays" class="control-label col-xs-4">Pays</label>
            <div class="col-xs-5">
                <input type="text" id="inputPays" name="pays" placeholder="France" class="form-control" required>

            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Email</label>
            <div class="col-xs-5">
                <input type="text" id="inputEmail" name="email" placeholder="john.doe@gmail.com"
                       class="form-control" required>

            </div>
        </div>
        <label for="inputInscription" class="control-label col-xs-4"></label>
        <input type="submit" id="inputInscription" value="Enregister" class="btn btn-primary"/>
</form>

<hr>

