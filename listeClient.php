<?php
session_start();
include_once ('header.html');
include('functions.php');
$bdd=getDataBase();
if($_SESSION['admin']=='1'){
    $query = $bdd->query("SELECT * FROM clients"); // mysql_fetch_query
?>
    <h1 class="text-center">Liste des clients</h1><br>
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th width="90"></th>
                <th class="text-center">Numéro</th>
                <th>Civilité</th>
                <th>Nom</th>
                <th width="110">Prénom</th>
                <th>Adresse</th>
                <th width="89">Date de naissance</th>
                <th>Email</th>
            </tr>
        </thead>
<?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
        while($donnees = $query->fetch()){ // mysql_fetch_array
?>
        <tr>
            <td>
                <a class="btn" href="delClient.php?id=<?=$donnees['numeroClient']?>" title="Supprimer le client">
                    <span class="glyphicon glyphicon-trash text-danger"></span>
                </a>
                <a href="updateClient.php?id=<?=$donnees['numeroClient']?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
            <td class="text-center"><?php echo $donnees['numeroClient'];?></td>
            <td><?php echo $donnees['civil'];?></td>
            <td><?php echo $donnees['nom'];?></td>
            <td><?php echo $donnees['prenom'];?></td>
            <td><?php echo $donnees['adresse'].", ".$donnees['codePostal']." ".$donnees['ville'].", ".$donnees['pays'];?></td>
            <td class="text-center"><?php echo $donnees['dateNaissance'];?></td>
            <td><?php echo $donnees['email'];?></td>
        </tr>
<?php
        } //fin de la boucle, le tableau contient toute la BDD
        $query->closeCursor(); //deconnection de mysql
?>
    </table>
<?php
}else{
    header('Location:panel.php');
}
include_once ('footer.html');
?>