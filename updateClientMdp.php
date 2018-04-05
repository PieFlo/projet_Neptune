<?php
if(isset($_POST['subpass'])){
    $o_password = $_POST['o_password'];
    $n_password = $_POST['n_password'];
    $r_password = $_POST['r_password'];

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
    }
}
?>

<form method="post" action="" class ="form-horizontal">
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
    <p>Ancien du mot de passe</p>
    <input type="password" name="o_password">
    <p>Nouveau du mot de passe</p>
    <input type="password" name="n_password">
    <p>Confirmation du nouveau du mot de passe</p>
    <input type="password" name="r_password">
    <br><br>
    <label for="editPassword" class="control-label col-xs-4"></label>
    <input type="submit" id="editPassword" value="Changer de mot de passe">
</form>