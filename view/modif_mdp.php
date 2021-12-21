<?php
session_start();


require_once(__DIR__ . "/../controllers/Toolbox.class.php");
require_once(__DIR__ . "/../controllers/Securite.class.php");
require_once(__DIR__ . "/../controllers/Visiteur/Visiteur.controller.php");
require_once(__DIR__ . "/../controllers/Utilisateur/Utilisateur.controller.php");
require_once(__DIR__ . "/../controllers/Administrateur/Administrateur.controller.php");






if (!isset($_SESSION['profil']['id'])) {
    header('Location:../index.php');
}

$utilisateurController = new UtilisateurController();


if (!empty($_POST['ancienPassword']) && !empty($_POST['nouveauPassword']) && !empty($_POST['confirmNouveauPassword'])) {
    $ancienPassword = Securite::secureHTML($_POST['ancienPassword']);
    $nouveauPassword = Securite::secureHTML($_POST['nouveauPassword']);
    $confirmationNouveauPassword = Securite::secureHTML($_POST['confirmNouveauPassword']);
    $utilisateurController->validation_modificationPassword($ancienPassword, $nouveauPassword, $confirmationNouveauPassword);
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zephyr Blog l'aventure">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <title>Zephyr Blog modifier password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


</head>

<body>




    <div class="general-main">


        <div class="container_diff">
            <?php require_once(__DIR__ . '/header_spe.php'); ?>

            <div class="text-center">

                <h1>Modification du mot de passe - <?= $_SESSION['profil']['login'] ?></h1>

                <form method="POST" action="modif_mdp.php">

                    <div class="col col-xs">
                        <label for="password" class="form-label">Ancien mot de passe</label>
                        <input type="password" class="form-control" id="ancienPassword" name="ancienPassword" required>
                    </div>
                    <div class="col col-xs">
                        <label for="nouveauPassword" class="form-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" id="nouveauPassword" name="nouveauPassword" required>
                    </div>
                    <div class="col col-xs">
                        <label for="confirmNouveauPassword" class="form-label">Confirmation nouveau mot de passe</label>
                        <input type="password" class="form-control" id="confirmNouveauPassword" name="confirmNouveauPassword" required>
                    </div>
                    <div class="alert alert-danger d-none" id="erreur">
                        Les passwords ne correspondent pas
                    </div>

                    <button type="submit" class="btn btn-secondary" id="btnValidation">Valider</button>

                </form>
                <?php require_once(__DIR__ . '/gestion_erreur.php'); ?>
            </div>



            <?php require_once(__DIR__ . '/footer_spe.php'); ?>

        </div>
    </div>
    <script>
        AOS.init({
            duration: 2000,
        })
    </script>
</body>

</html>