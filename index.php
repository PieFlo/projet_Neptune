<?php
session_start();
if (!empty($_SESSION)){
    header('Location:panel.php');
}else session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="images/hostel-black.png">
    <link rel="stylesheet" href="bootstrap/docs/dist/css/bootstrap.min.css">
    <script src="bootstrap/js/tests/vendor/jquery.min.js"></script>
    <script src="bootstrap/docs/dist/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accueil - Hôtel Neptune</title>

</head>
<body>
<!-- NaveBar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="logo pull-left" href="index.php"><img src="images/hostel-white.png" width="45" height="45"/></a>
            <a class="navbar-brand" href="index.php">&nbsp;&nbsp;Hôtel Neptune</a>
        </div>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right">

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#login">Connexion
                </button>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#register">Inscription
                </button>

            </form>
        </div>
    </div>
</nav>
<!-- Modal inscription-->
<div id="register" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="register.php" onsubmit="return identicalPassword(this);" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inscription</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNom" class="control-label col-xs-4">Nom</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputNom" name="nom" placeholder="Doe" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrenom" class="control-label col-xs-4 col-form-label">Prénom</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputPrenom" name="prenom" placeholder="John" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCivil" class="control-label col-xs-4">Civilité</label>
                        <div class="col-xs-5">
                            <select id="inputCivil" name="civil" class="form-control" required>
                                <option value="Monsieur">Monsieur</option>
                                <option value="Madame">Madame</option>
                                <option value="Mademoiselle">Mademoiselle</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDateNaissance" class="control-label col-xs-4">Date de naissance</label>
                        <div class="col-xs-5">
                            <input type="date" id="inputDateNaissance" name="dateNaissance" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAdresse" class="control-label col-xs-4">Adresse</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputAdresse" name="adresse" placeholder="19 Rue Turgot"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCodePostal" class="control-label col-xs-4">Code postal</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputCodePostal" name="codePostal" placeholder="75009"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputVille" class="control-label col-xs-4">Ville</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputVille" name="ville" placeholder="Paris" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPays" class="control-label col-xs-4">Pays</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputPays" name="pays" placeholder="France" class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label col-xs-4">Email</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputEmail" name="email" placeholder="john.doe@gmail.com"
                                   class="form-control" required>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label col-xs-4">Mot de passe</label>
                        <div class="col-xs-5">
                            <input type="password" id="inputPassword" name="password" placeholder="********"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRepeatPassword" class="control-label col-xs-4">Confirmation du<br>mot de
                            passe</label>
                        <div class="col-xs-5">
                            <input type="password" id="inputRepeatPassword" name="repeatpassword" placeholder="********"
                                   class="form-control" required><br>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <label for="inputInscription" class="control-label col-xs-4"></label>
                <input type="submit" id="inputInscription" value="S'inscrire" class="btn btn-primary"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>
<!-- Modal connexion-->
<div id="login" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="login.php" class="form-horizontal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Connexion</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="inputCoEmail" class="control-label col-xs-4">Email</label>
                        <div class="col-xs-5">
                            <input type="text" id="inputCoEmail" name="email" placeholder="john.doe@gmail.com"
                                   class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCoPassword" class="control-label col-xs-4">Mot de passe</label>
                        <div class="col-xs-5">
                            <input type="password" id="inputCoPassword" name="password" placeholder="********"
                                   class="form-control" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <label for="inputConnexion" class="control-label col-xs-4"></label>
                <input type="submit" id="inputConnexion" value="Se connecter" class="btn btn-primary"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>

    </div>
</div>
<br>
<!-- Corps de la page -->
<div class="jumbotron">
    <div class="container">
        <h1>Bienvenue à vous !</h1>
        <p>Vous êtes actuellement sur le site internet de l'hôtel Neptune. Ici vous pouvez vous inscrire ou si cela est
            déjà fait,
            vous connecter à votre compte. Une fois cela éffectué vous pourrez visualiser les 5.000 chambres de l'hôtel
            et ainsi réserver
            celle(s) qui vous correspondrons le plus, parmis celles disponibles.</p>
    </div>
</div>

<img src="images/neptune_hotel.jpg" alt="Hôtel Neptune" class="img-circle center-block" width="904" height="636"/>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <h2>Offres Spéciales</h2>
            <p>Pour les grandes occasions telles que la Saint Valentin, Noël, le jour de l'an ou encore bien d'autres,
                l'hôtel Neptune crée des offres spéciales permettants aux personnes souhaîtants réserver une chambre
                durant
                ces occasions de bénéficier d'offres exceptionnelles telle que des réductions, des avantages ainsi que
                bien d'autres choses.</p>
            <!--<p><a class="btn btn-default" href="#" role="button">Voir Plus De Détails &raquo;</a></p>-->
        </div>
        <div class="col-md-4">
            <h2>Circuits et Séjours</h2>
            <p>L'hôtel Neptune bénéficient d'une location idilique nous suggérons à nos clients de nombreuses activitées
                aux alentours qui pourrons les intéressés et les distraires.</p>
            <!--<p><a class="btn btn-default" href="#" role="button">Voir Plus De Détails &raquo;</a></p>-->
        </div>
        <div class="col-md-4">
            <h2>Avis et Témoignages</h2>
            <p>L'hôtel Neptune existant depuis depuis de nombreuses années, nous avons pu receuillir de nombreux avis
                sur
                l'hôtel en général ainsi que sur ces services, ses chambres, ses activitées proposées et bien d'autres.
                Nous vous permettons ainsi de découvrir ces avis divers afin de vous aider dans votre choix et ainsi
                pouvoir
                vous aider à vous décider dans le cas où vous hésiteriez entre deux hôtels.</p>
            <!--<p><a class="btn btn-default" href="#" role="button">Voir Plus De Détails &raquo;</a></p>-->
        </div>
    </div>
    <?php
//    echo '<pre>';
//    print_r($GLOBALS);
//    echo '</pre>';
    ?>
    <hr>

    <footer>
        <p>&copy; 2019 Poujol Pierre-Florent - EPSI Montpellier - Bachelor 2</p>
    </footer>
</div>
<script type="text/javascript">
    function identicalPassword(form){
        if(form.password.value != form.repeatpassword.value){
            alert("Les mots de passe ne correspondent pas. Veuillez réessayer.");
            return false;
        } else return true;
    }
</script>
</body>

</html>