<?php
session_start();
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
                echo "Nouveau mot de passe enregistré avec succès !";
            else
                echo "Echec du changement de mot de passe !";
        }else
            echo "Ancien mot de passe erroné !";
    }else
        echo "les nouveaux mots de passe ne corresondent pas !";


/*
    //$o_password = md5($o_password);

    $query = $bdd->prepare("SELECT * FROM clients WHERE prenom='{$_SESSION['numeroClient']}' AND password='$o_password'") or die('Erreur : ' . $e->getMessage());
    $query->execute(); // Exécute la requette $query.

    // $rows = mysql_num_rows($query);


    if(empty($o_password)){
        echo "Veuillez saisir votre ancien mot de passe !";
    }else if($n_password != $r_password){
        echo "Vos nouveaux mots de passe sont différents !";
    }else if($rows == 0){
        echo "L'ancien mot de passe est incorrect !";
    }else{
        //$n_password = md5($n_password);

        $query = $bdd->prepare("UPDATE clients SET password='$n_password' WHERE prenom='{$_SESSION['prenom']}'");
        $query->execute(); // Exécute la requette $query.

        header("Location:panel.php");
    }*/
}
?>

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
<?php echo '<pre>';
print_r($GLOBALS);
echo '</pre>';

function checkPassword($bdd, $currentPassword, $currentNumCli){
    $query = $bdd->prepare("SELECT password FROM clients WHERE numeroClient = :currentNumCli");
    $query->bindParam(':currentNumCli', $currentNumCli);
    $query->execute();
    $clients = $query->fetch(PDO::FETCH_OBJ);
    if ($clients->password==$currentPassword)
        return true;
    else
        return false;
}
?>