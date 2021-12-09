<?php
session_start();

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$administrateurController = new AdministrateurController();


if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['mail'] && !empty($_POST['nom']) && !empty($_POST['prenom']))) {

    if ($_POST['password'] == $_POST['confirm_password']) {
        $login = Securite::secureHTML($_POST['login']);
        $prenom = Securite::secureHTML($_POST['prenom']);
        $nom = Securite::secureHTML($_POST['nom']);
        $password = Securite::secureHTML($_POST['password']);
        $mail = Securite::secureHTML($_POST['mail']);
        $utilisateurController->validation_creerCompte($login, $prenom, $nom, $password, $mail);
    } else {
        Toolbox::ajouterMessageAlerte("le Mdp n'est pas identique", Toolbox::COULEUR_ROUGE);
    }
}

if (isset($_SESSION['profil']['id'])) {
    header('Location:index.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/welcome.css">
    <link rel="stylesheet" href="./public/css/login.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <header class="header_login">

        <?php require_once('./view/header.php'); ?>

    </header>


    <div class="login">
        <form method="POST" action="inscription.php">
            <h4>Création de compte</h4>
            <div class="social-media">
                <p><i class="fab fa-google"></i></p>
                <p><i class="fab fa-youtube"></i></p>
                <p><i class="fab fa-facebook-f"></i></p>
                <p><i class="fab fa-twitter"></i></p>
            </div>
            <div class="inputs">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" required>
                <label for="mail">mail</label>
                <input type="mail" id="mail" name="mail" required>
                <label for="prenom">prenom</label>
                <input type="text" id="prenom" name="prenom" required>
                <label for="nom">nom</label>
                <input type="text" id="nom" name="nom" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm_password"> Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div align="center">
                <button type="submit">Créer !</button>
            </div>
            <?php
            if (isset($_SESSION['alert'])) {
                foreach ($_SESSION['alert'] as $alert) {
                    echo "<div class='alert " . $alert['type'] . "' role='alert'>
                        " . $alert['message'] . "
                    </div>";
                }
                unset($_SESSION['alert']);
            }
            ?>
        </form>

        <?php require_once('./view/gestion_erreur.php'); ?>

    </div>

    <?php require_once('./view/footer.php'); ?>



</body>

</html>