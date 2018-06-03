<?php
session_start();
include_once('header.html');
include_once('functions.php');

$bdd = getDataBase();
$query = $bdd->query('SELECT idReservation, numeroChambre, arrivee, depart, payee FROM reservations WHERE numeroCLient ='.$_SESSION['numeroClient']);
$result = $query->rowCount();

if ($result == 0){
    // par de réseration dans la base
    $query->closeCursor();
    echo "Vous n'avez effectué aucune réservation.";
} else {
    $reservations = $query->fetchAll();
    $reservation = end($reservations);
    if(strtotime(date("Y-m-d")) < strtotime($reservation["depart"])){
        // reservation trouvé dans le futur
        $query = $bdd->query('SELECT * FROM chambres WHERE numeroChambre ='.$reservation["numeroChambre"]);
        $chambre = $query->fetch();
        //affichage de la réservation
?>
        <div class="panel panel-default">
            <div class="panel-heading">
            <?php echo "<h4 class='text-center'>Votre réservation pour la période du ".$reservation["arrivee"]." au ".$reservation["depart"]."</h4>"; ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-5"><img src="images/chambre1.jpg" alt="Chambre de l'hôtel Neptune" height="300"/>
                    </div>
                    <div class="col-lg-4">
                        <h4><strong>Chambre n°<?= $chambre["numeroChambre"] ?></strong></h4><br>
                        <?php
                        for ($i = 1; $i <= $chambre["capacite"]; $i++)
                            echo "<span  class=\"glyphicon glyphicon-user\"></span>";
                        ?><br><br><br>
                        Descrition : Chambre pour <?= $chambre["capacite"] ?> personnes situé au <?= $chambre["etage"] ?>ème
                        étage avec vu sur <?= $chambre["exposition"] ?>.
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2 row">
                        <div class="center-block"><br><br><br>
                            <?php
                            if ($chambre["douche"] == 1) echo "<img src='images/douche.png' alt='douche'/>";
                            if ($chambre["douche"] != 1 && $chambre["bain"] != 1) echo "<img src='images/noDouche.png' alt='douche' height='50'/>";
                            if ($chambre["bain"] == 1) echo "<img src='images/baignoire.png' alt='baignoire'/>";
                            if ($chambre["wc"] == 1) echo " <img src='images/WC.png'/>";
                            else echo " <img src='images/noWC.png'/>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <form action="delReserv.php" method="post">
                        <input type="hidden" name="arrivee" value="<?= $reservation["arrivee"] ?>"/>
                        <input type="hidden" name="idReservation" value="<?= $reservation["idReservation"] ?>"/>
                        <input type="submit" value="Annuler la réservation" class="btn btn-danger"/>
                    </form>
                </div>


            </div>
        </div>
<?php
    }
    else echo "Vous n'avez effectué aucune réservation.";
    // reseration trouvé mais dans le passé
    $query->closeCursor();
}
?>
<br>
<?php
// displayVar();
include_once ('footer.html');
?>