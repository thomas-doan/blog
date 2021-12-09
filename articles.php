<?php
session_start();

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();


$getArticles =  $visiteurController->tousLesArticles();

/* var_dump($get3Articles); */
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zephyr Blog l'aventure">
    <link rel="stylesheet" href="./public/css/welcome.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <title>Zephyr Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>







    <div class="container_diff">
        <?php require_once('./view/header_spe.php'); ?>



        <main class="c_main">



            <section class="c_section_transition">
                <p>NOS ARTICLES</p>
            </section>

            <section class="c_section_carte">
                <?php foreach ($getArticles as $articles) {
                ?>

                    <div class="container_sct">
                        <a href="./article.php?id=<?= $articles['id'] ?>">
                            <div style="         position: absolute;
                background-image: url('<?= $articles['image'] ?>');
                height: 10rem;
                width: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;">
                            </div>
                            <img src='<?= $articles['image'] ?>' alt='profile image' class="profile-img">
                            <p class="name"><?= $articles['titre'] ?></p>
                            <p class="description"><?= $articles['description'] ?></p>
                            <a href="./article.php?id=<?= $articles['id'] ?>">Lire la suite</a>
                        </a>
                    </div>

                <?php } ?>


            </section>
            <section class="c_section_transition">
                <span style="font-size: 3rem; color: rgb(181, 150, 104);">
                    <i class="fa fa-paper-plane"></i>
                </span>

                <p id="abonnement">Nos aventures !</p>
                <form action="#">
                    <input type="text" name="" value="" placeholder="nous suivre par email" required="">
                    <input type="submit" name="" value="Envoyer">
                </form>
            </section>



        </main>
        <?php require_once('./view/footer.php'); ?>


    </div>

</body>

</html>