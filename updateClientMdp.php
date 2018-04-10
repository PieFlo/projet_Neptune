<?php
session_start();
include_once('header.html');
include_once('connexionBDD.php');
if (isset($_POST) && count($_POST) > 0) {
    extract(array_map("htmlspecialchars", $_POST));
    $bdd=getDataBase();
    if ($newPassword==$repeatNewPassword){
        //$query = $bdd->prepare("SELECT password FROM clients WHERE numeroClient = :sessionNumCli");
        //$query->bindParam(':sessionNumCli', $_SESSION['numeroClient']);
        //$query->execute();
        //$clients = $query->fetch(PDO::FETCH_OBJ);
        $passwordMatch = checkPassword($bdd, $holdPassword, $_SESSION['numeroClient']);
        //if ($clients->password==$holdPassword){
        if ($passwordMatch==true){
            $query = $bdd->prepare("UPDATE clients SET password = :newPassword WHERE numeroClient = :sessionNumCli");
            $query->bindParam(':newPassword', $newPassword);
            $query->bindParam(':sessionNumCli', $_SESSION['numeroClient']);
            $query->execute(); // Exécute la requette $query.
            $passwordMatch = checkPassword($bdd, $newPassword, $_SESSION['numeroClient']);
            if ($passwordMatch==true)
                echo "<div class=\"alert alert-success\">Nouveau mot de passe enregistré avec succès !</div>";
            else
                echo "<div class=\"alert alert-danger\">Echec du changement de mot de passe !</div>";
        }else
            echo "<div class=\"alert alert-danger\">Ancien mot de passe erroné !</div>";
    }else
        echo "<div class=\"alert alert-danger\">les nouveaux mots de passe ne corresondent pas !</div>";
}
?>
    <h1 class="text-center">Changement de mot de passe</h1><br><br>
<form method="post" action="updateClientMdp.php" class ="form-horizontal">
    <div class="form-group">
        <label for="inputHoldPassword" class="control-label col-xs-4">Ancien mot de passe</label>
        <div class="col-xs-5">
            <input type="password" id="inputHoldPassword" name="holdPassword" placeholder="********"
                   class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputNewPassword" class="control-label col-xs-4">Nouveau mot de passe</label>
        <div class="col-xs-5">
            <input type="password" id="inputNewPassword" name="newPassword" placeholder="********"
                   class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputRepeatNewPassword" class="control-label col-xs-4">Confirmation du nouveau mot de
            passe</label>
        <div class="col-xs-5">
            <input type="password" id="inputRepeatNewPassword" name="repeatNewPassword" placeholder="********"
                   class="form-control" required><br>
        </div>
    </div>
    <label for="editPassword" class="control-label col-xs-4"></label>
    <input type="submit" id="editPassword" value="Enregister" class="btn btn-primary">
</form>
<?php

function checkPassword($bdd, $currentPassword, $currentNumCli){
    $query = $bdd->prepare("SELECT password FROM clients WHERE numeroClient = :currentNumCli");
    $query->bindParam(':currentNumCli', $currentNumCli);
    $query->execute();
    $passwordInBD = $query->fetchColumn();
    if ($passwordInBD==$currentPassword)
        return true;
    else
        return false;
}
include_once('footer.html');
?>