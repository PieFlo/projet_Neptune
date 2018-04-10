<?php
session_start();
include_once('header.html');
include_once ('connexionBDD.php');
if (isset($_POST) && count($_POST) > 0) {
    extract(array_map("htmlspecialchars", $_POST));
    $bdd = getDataBase();
    try {
        $stmt = $bdd->prepare("UPDATE clients SET civil = :civil, nom = :nom, prenom = :prenom, 
        adresse = :adresse, codePostal = :codePostal, ville = :ville, pays = :pays, 
        dateNaissance = :dateNaissance, email = :email WHERE numeroClient = :numeroClient");
        $stmt->bindParam(':civil', $civil);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':codePostal', $codePostal);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':pays', $pays);
        $stmt->bindParam(':dateNaissance', $dateNaissance);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':numeroClient', $numeroClient);
        $nbModifs = $stmt->execute();
    } catch (Exception $e) {
        $nbModifs = 0;
    }
    if ($nbModifs == 1) {
        echo "<div class=\"alert alert-success\">La mise à jour a réussie.</div>";
    } else {
        echo "<div class=\"alert alert-danger\">La mise à jour a échoués</div>";
    }
} else {
    $numeroClientToEdit = -1;
    if(isset($_GET) && count($_GET) > 0 && $_SESSION['admin']== true){
        $numeroClientToEdit = $_GET['id']; // si l'admin modifi un client
    }else{
        $numeroClientToEdit = $_SESSION['numeroClient']; // quand un client modifi ses propres infos
    }
    if ($numeroClientToEdit > 0){ // a-t-on bien le numéro d'un client ?

        $bdd = getDataBase();
        $query = $bdd->prepare("SELECT * FROM clients WHERE numeroClient=:numeroClientToEdit");
        $query->bindParam(':numeroClientToEdit', $numeroClientToEdit);
        $query->execute();

        $clients = $query->fetch(PDO::FETCH_OBJ);
        if (! $clients) {
            $numeroClientToEdit = -1;
        }
    }
    ?>
    <h1 class="text-center">Modifier les informations</h1><br>
    <form method="post" action="updateClient.php" class="form-horizontal">

        <div class="form-group">
                <input type="hidden" id="inputNumCli" name="numeroClient" class="form-control" value="<?php echo $clients->numeroClient?>">
        </div>
        <div class="form-group">
            <label for="inputNom" class="control-label col-xs-4">Nom</label>
            <div class="col-xs-5">
                <input type="text" id="inputNom" name="nom" class="form-control" value="<?php echo $clients->nom ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPrenom" class="control-label col-xs-4 col-form-label">Prénom</label>
            <div class="col-xs-5">
                <input type="text" id="inputPrenom" name="prenom" class="form-control" value="<?php echo $clients->prenom ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputCivil" class="control-label col-xs-4">Civilité</label>
            <div class="col-xs-5">
                <select id="inputCivil" name="civil" class="form-control"  required>
                    <option value="Monsieur" <?php echo ($clients->civil=="Monsieur") ? "selected" : ""; ?>>Monsieur</option>
                    <option value="Madame" <?php echo ($clients->civil=="Madame") ? "selected" : ""; ?>>Madame</option>
                    <option value="Mademoiselle" <?php echo ($clients->civil=="Mademoiselle") ? "selected" : ""; ?>>Mademoiselle </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputDateNaissance" class="control-label col-xs-4">Date de naissance</label>
            <div class="col-xs-5">
                <input type="date" id="inputDateNaissance" name="dateNaissance" class="form-control" value="<?php echo $clients->dateNaissance ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAdresse" class="control-label col-xs-4">Adresse</label>
            <div class="col-xs-5">
                <input type="text" id="inputAdresse" name="adresse"
                       class="form-control" value="<?php echo $clients->adresse ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputCodePostal" class="control-label col-xs-4">Code postal</label>
            <div class="col-xs-5">
                <input type="text" id="inputCodePostal" name="codePostal"
                       class="form-control" value="<?php echo $clients->codePostal ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputVille" class="control-label col-xs-4">Ville</label>
            <div class="col-xs-5">
                <input type="text" id="inputVille" name="ville" class="form-control" value="<?php echo $clients->ville ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPays" class="control-label col-xs-4">Pays</label>
            <div class="col-xs-5">
                <input type="text" id="inputPays" name="pays" class="form-control" value="<?php echo $clients->pays ?>" required>

            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-4">Email</label>
            <div class="col-xs-5">
                <input type="text" id="inputEmail" name="email"
                       class="form-control" value="<?php echo $clients->email ?>" required>
            </div>
        </div>
        <label  class="control-label col-xs-4"></label>
        <input type="submit" value="Enregister" class="btn btn-primary"/>
    </form>

    <?php
}
//echo '<pre>';
//print_r($GLOBALS);
//echo '</pre>';
include_once('footer.html');
?>


