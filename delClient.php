<?php
session_start();
$numeroClientToDelete = -1;
include_once ('header.html');
include_once('functions.php');
if(isset($_GET) && count($_GET) > 0 && $_SESSION['admin'] == true){
    if(isset($_GET['id'])){
        $numeroClientToDelete = htmlspecialchars($_GET['id']); // quand un client modifi ses propres infos
        $bdd = getDataBase();
        $query = $bdd->prepare("SELECT numeroClient, nom, prenom FROM clients WHERE numeroClient=:numeroClientToDelete");
        $query->bindParam(':numeroClientToDelete', $numeroClientToDelete);
        $query->execute();

        $clients = $query->fetch(PDO::FETCH_OBJ);
    }

    if(isset($_GET['req']) && is_numeric($_GET['req'])) {
        if (intval($_GET['req']) == 1) {
            echo "<div class=\"alert alert-success\">La suppression du client a réussie.</div>";
        }
    } else {
        ?>
        <h1 class="text-center">Supprmier un client</h1><br>
        <form method="post" action="unregister.php" class="form-horizontal">

            <div class="form-group">
                <input type="hidden" id="inputNumCli" name="numeroClient" class="form-control" value="<?php echo $clients->numeroClient?>">
            </div>
            <div class="form-group">
                <label for="inputNom" class="control-label col-xs-4">Numéro de client</label>
                <div class="col-xs-5">
                    <input type="text" id="inputNom" name="nom" class="form-control" value="<?php echo $clients->numeroClient ?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="inputNom" class="control-label col-xs-4">Nom</label>
                <div class="col-xs-5">
                    <input type="text" id="inputNom" name="nom" class="form-control" value="<?php echo $clients->nom ?>" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPrenom" class="control-label col-xs-4 col-form-label">Prénom</label>
                <div class="col-xs-5">
                    <input type="text" id="inputPrenom" name="prenom" class="form-control" value="<?php echo $clients->prenom ?>" disabled>
                </div>
            </div>
            <label  class="control-label col-xs-4"></label>
            <input type="submit" value="Supprimer" class="btn btn-danger"/>
        </form>

        <?php
    }
} else header('Location:panel.php');
include_once ('footer.html');
?>
