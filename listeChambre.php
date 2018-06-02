<?php
session_start();
include_once('connexionBDD.php');
include_once('header.html');
?>
<h1 class="text-center">Liste des Chambres</h1><br>
<form action="" method="post" class="form-inline">

    <div class="form-group">
        <label for="Date">Réserver du </label>
        <input type="date" id="" name="" class="form-control" value="" required>
        <label for="Date"> au </label>
        <input type="date" id="" name="" class="form-control" value="" required>
    </div>

    <input type="submit" value="Chercher" class="btn btn-default"/>
</form>
<br>
<?php
$bdd = getDataBase();
$query = "SELECT numeroChambre, capacite, exposition, douche, wc, bain, etage, prix FROM chambres, tarifs where chambres.tarif = tarifs.codeTarif ";
$stmt = $bdd->prepare($query);
$stmt->execute();
$chambres = $stmt->fetchAll(PDO::FETCH_OBJ);

?>
<div class="panel-group">
    <?php foreach ($chambres as $chambre) { ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">

                    <div class="col-lg-4"><img src="images/chambre1.jpg" alt="Chambre de l'hôtel Neptune" height="225"/>
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
                            <div class="pull-right"><a>
                                    <button class="btn">Réserver cette chambre</button>
                                </a></div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php

include_once('footer.html');
?>
