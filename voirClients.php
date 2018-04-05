<?php 
session_start();
include('connectionBDD.php');
$query = $bdd->query("SELECT * FROM clients"); // mysql_fetch_query
if(isset($_SESSION['admin']=='1')){
//if(isset($_SESSION['email']=='Admin@gmail.com')){
?>

<center>
<table>
            <tr>
            	<th>Numéro Client : </th>
            	<th>Civil : </th>
                <th>Nom : </th>
                <th>Prénom : </th>
                <th>Adresse : </th>
                <th>Code Postal : </th>
                <th>Ville : </th>
                <th>Pays : </th>
                <th>Date de naissance : </th>
                <th>Email : </th>
            </tr>
            <?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
            while($donnees = $query->fetch()){ // mysql_fetch_array
            ?>
                <tr>
                	<td><?php echo $donnees['numeroClient'];?></td>
                	<td><?php echo $donnees['civil'];?></td>
                    <td><?php echo $donnees['nom'];?></td>
                    <td><?php echo $donnees['prenom'];?></td>
                    <td><?php echo $donnees['adresse'];?></td>
                    <td><?php echo $donnees['codePostal'];?></td>
                    <td><?php echo $donnees['ville'];?></td>
                    <td><?php echo $donnees['pays'];?></td>
                    <td><?php echo $donnees['dateNaissance'];?></td>
                    <td><?php echo $donnees['email'];?></td>
                </tr>
            <?php
            } //fin de la boucle, le tableau contient toute la BDD
            $query->closeCursor(); //deconnection de mysql
            ?>

</table>
</center>

<?php
}else{
    header('Location:membre.php');
}
?>