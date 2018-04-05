<?php 
session_start();
include('connectionBDD.php');
$query = $bdd->query("SELECT * FROM chambres"); // mysql_fetch_query
?>

<center>
<table>
            <tr>
            	<th>ID : </th>
            	<th>Capacité : </th>
                <th>Exposition : </th>
                <th>Douche : </th>
                <th>WC : </th>
                <th>Bain : </th>
                <th>Etage : </th>
                <th>Tarif : </th>
            </tr>
            <?php //On affiche les lignes du tableau une à une à l'aide d'une boucle
            while($donnees = $query->fetch()){ // mysql_fetch_array
            ?>
                <tr>
                	<td><?php echo $donnees['numeroChambre'];?></td>
                	<td><?php echo $donnees['capacite'];?></td>
                    <td><?php echo $donnees['exposition'];?></td>
                    <td><?php echo $donnees['douche'];?></td>
                    <td><?php echo $donnees['wc'];?></td>
                    <td><?php echo $donnees['bain'];?></td>
                    <td><?php echo $donnees['etage'];?></td>
                    <td><?php echo $donnees['tarif'];?></td>
                </tr>
            <?php
            } //fin de la boucle, le tableau contient toute la BDD
            $query->closeCursor(); //deconnection de mysql
            ?>

</table>
</center>