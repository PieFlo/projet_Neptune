<?php
session_start();
include_once('functions.php');
include_once('header.html');
?>
<h1 class="text-center">Réservation de chambre</h1><br>
<form action="listeChambre.php" method="post" class="form-inline">

    <div class="form-group">
        <label for="Date">Réserver du </label>
        <input type="date" id="arrivee" name="arrivee" class="form-control" value="<?= isset($_POST["arrivee"])? $_POST["arrivee"] : "";?>" required>
        <label for="Date"> au </label>
        <input type="date" id="depart" name="depart" class="form-control" value="<?= isset($_POST["depart"]) ? $_POST["depart"] : "";?>" required>
    </div>
    <input type="submit" value="Chercher" class="btn btn-default"/>
</form>
<br>
<?php
$bdd = getDataBase();
$queryWhere = "";

if (isset($_POST) && count($_POST) > 0) {

    $stmt=$bdd->prepare("SELECT DISTINCT numeroChambre FROM reservations WHERE (arrivee BETWEEN :arrivee AND :depart) AND (depart BETWEEN :arrivee AND :depart) OR (:arrivee BETWEEN arrivee AND depart) OR (:depart BETWEEN arrivee AND depart)");
    $stmt->bindParam(':arrivee', $_POST["arrivee"]);
    $stmt->bindParam(':depart', $_POST["depart"]);
    $stmt->execute();
    while ($donnees = $stmt->fetch()){
        $queryWhere = $queryWhere." AND chambres.numeroChambre !=".$donnees['numeroChambre'];
    }


$stmt = $bdd->prepare("SELECT chambres.numeroChambre, capacite, exposition, douche, wc, bain, etage, prix, URL FROM chambres, tarifs, chambresphotos where chambres.numeroChambre = chambresphotos.numeroChambre AND chambres.tarif = tarifs.codeTarif".$queryWhere);
$stmt->execute();
$chambres = $stmt->fetchAll(PDO::FETCH_OBJ);
//displayVar();
?>
<div class="panel-group">
    <?php foreach ($chambres as $chambre) { ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-4"><img src="<?= $chambre->URL ?>" alt="Chambre de l'hôtel Neptune" height="225"/>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel-heading row">
                            <div class="col-lg-6"><h4><strong>Chambre n°<?= $chambre->numeroChambre ?></strong></h4>
                            </div>
                            <div class="col-lg-6">
                                <h4 class="pull-right"><strong><?= $chambre->prix ?>€&nbsp;&nbsp;&nbsp;</strong></h4>
                            </div>
                        </div>

                        <div class="panel-body" style="min-height: 100px;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
                                    for ($i = 1; $i <= $chambre->capacite; $i++)
                                        echo "<span  class=\"glyphicon glyphicon-user\"></span>";
                                    ?><br><br>
                                    Chambre pour <?= $chambre->capacite ?> personnes situé au <?= $chambre->etage ?>ème
                                    étage avec vu sur <?= $chambre->exposition ?>.
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-3 row">
                                    <div class="center-block">
                                        <?php
                                        if ($chambre->douche == 1) echo "<img src='images/douche.png' alt='douche'/>";
                                        if ($chambre->douche != 1 && $chambre->bain != 1) echo "<img src='images/noDouche.png' alt='douche' height='50'/>";
                                        if ($chambre->bain == 1) echo "<img src='images/baignoire.png' alt='baignoire'/>";
                                        if ($chambre->wc == 1) echo " <img src='images/WC.png'/>";
                                        else echo " <img src='images/noWC.png'/>";
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer clearfix">
                            <div class="pull-right">
                                <form action="addReserv.php" method="post">
                                    <input type="hidden" name="arrivee" value="<?= $_POST["arrivee"] ?>"/>
                                    <input type="hidden" name="depart" value="<?= $_POST["depart"] ?>"/>
                                    <input type="hidden" name="numeroChambre" value="<?= $chambre->numeroChambre ?>"/>
                                    <input type="submit" value="Réserver cette chambre" class="btn"/>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
}
include_once('footer.html');
?>
