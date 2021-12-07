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


if (!empty($_POST['login']) && !empty($_POST['password'])) {

    if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $login = Securite::secureHTML($_POST['login']);
        $password = Securite::secureHTML($_POST['password']);
        $utilisateurController->validation_login($login, $password);
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<?php
// var_dump($_SESSION);

?>

<body>

    <header class="header_login">

        <?php require_once('./view/header.php'); ?>

    </header>


    <div class="login">
        <form method="POST" action="login.php">

            <h4>Se connecter</h4>
            <div class="social-media">
                <p><i class="fab fa-google"></i></p>
                <p><i class="fab fa-youtube"></i></p>
                <p><i class="fab fa-facebook-f"></i></p>
                <p><i class="fab fa-twitter"></i></p>
            </div>

            <p class="choose-email">ou utiliser mon login :</p>

            <div class="inputs">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>


            <div align="center">
                <button type="submit">Connexion</button>
            </div>

            <?php require_once('./view/gestion_erreur.php'); ?>

        </form>
    </div>

    <?php require_once('./view/footer.php'); ?>



</body>

</html>