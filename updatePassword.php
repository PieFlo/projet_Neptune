<?php
if(isset($_POST['subpass'])){
    $o_password = $_POST['o_password'];
    $n_password = $_POST['n_password'];
    $r_password = $_POST['r_password'];

    //$o_password = md5($o_password);

    $query = $bdd->prepare("SELECT * FROM clients WHERE prenom='{$_SESSION['prenom']}' AND password='$o_password'") or die('Erreur : ' . $e->getMessage());
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

        header("Location:membre.php");
    }
}
?>

<form method="post">
    <p>Ancien du mot de passe</p>
    <input type="password" name="o_password">
    <p>Nouveau du mot de passe</p>
    <input type="password" name="n_password">
    <p>Confirmation du nouveau du mot de passe</p>
    <input type="password" name="r_password">
    <br><br>

    <input type="submit" name="subpass" value="Changer de mot de passe">
</form>