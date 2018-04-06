<?php
include_once('headerUnlogged.html');
include_once('connexionBDD.php');

if (isset($_POST) && count($_POST) > 0) { // Quand on presse le bouton 'submit' alors ...

    extract(array_map("htmlspecialchars", $_POST));
    $bdd = getDataBase();
    $query = $bdd->prepare("SELECT * FROM clients WHERE email=:email");
    $query->bindParam(':email', $email);
    $query->execute();
    $rows = $query->rowCount();
    if ($rows != 0) {
        echo "Cette adresse email est déjà utilisé.";
    } else {
        try {
            $stmt = $bdd->prepare("INSERT INTO clients(civil, nom, prenom, adresse, codePostal, ville, pays, 
                                            dateNaissance, email, password) VALUES (:civil, :nom, :prenom, :adresse, 
                                            :codePostal, :ville, :pays, :dateNaissance, :email, :password)");
            $stmt->bindParam(':civil', $civil);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':codePostal', $codePostal, PDO::PARAM_INT);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':pays', $pays);
            $stmt->bindParam(':dateNaissance', $dateNaissance);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $nbInsert = $stmt->execute();
        } catch (Exception $e) {
            $nbInsert = 0;
        }
        if ($nbInsert == 1) {
            echo "Votre inscription a bien été prise en compte, vous pouvez maintenant vous connecter.";
        } else {
            echo "Votre inscription a échoué, veuillez réessayer.";
        }
    }
} else {
    header('Location:index.php');
}
/*echo '<pre>';
print_r($GLOBALS);
echo '</pre>';*/
include_once('footer.html');
?>
