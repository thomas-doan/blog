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



if (!Securite::estConnecte()) {
    header('Location:index.php');
} elseif (Securite::estConnecte() && !Securite::estAdministrateur()) {
    header('Location:index.php');
}



$getLogin = $administrateurController->droits();
$getIdArticles = $administrateurController->liste_articles();

if (isset($_POST['id']) && isset($_POST['message']) && isset($_POST['article'])) {
    $message = Securite::secureHTML($_POST['message']);
    $administrateurController->admin_creer_com($_POST['id'], $message, $_POST['article']);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/css/login.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <title>Zephyr Blog admin creation commentaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>

    <div class="general-main">


        <div class="container_diff">

            <?php require_once('./view/header_spe.php'); ?>
            <div class="container_creer_com">


                <div class="container_com_item">
                    <h1>Créer des commentaires</h1>
                    <div class="com">

                        <form method="POST" action="admin_creer_com.php">


                            <div class="menu">
                                <label for="user-select">Choisir utilisateur:</label>
                                <select name="id">

                                    <?php foreach ($getLogin as $login) {


                                    ?>
                                        <option value="<?= $login['id'] ?>"><?= $login['login'] ?></option>

                                    <?php
                                    } ?>
                                </select>


                                <label for="article-select">Choisir article:</label>
                                <select name="article">

                                    <?php foreach ($getIdArticles as $article) { ?>
                                        <option value="<?= $article['id'] ?>"><?= $article['titre'] ?></option>

                                    <?php } ?>
                                </select>

                            </div>











                            <textarea name="message" placeholder="Poster votre commentaire" require></textarea>
                            <button class="btn btn-primary" type="submit">Envoyer</button>

                        </form>
                        <?php require_once('./view/gestion_erreur.php'); ?>


                    </div>
                    <a href="./administration_com.php"><button class="btn btn-success" type="submit">Retour liste commentaire</button></a>
                </div>



            </div>




        </div>
        <?php require_once('./view/footer.php'); ?>

    </div>
    </div>
    <script>
        AOS.init({
            duration: 2000,
        })
    </script>

</body>

</html>