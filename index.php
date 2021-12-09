<?php
session_start();

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();


$get3Articles =  $visiteurController->troisArticlesRecents();

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







    <div class="container">
        <?php require_once('./view/header.php'); ?>



        <main class="c_main">
            <section class="c_section1">
                <h2>VOYAGE & SURF</h2>
                <img id="fleche" src="./public/image/icone_fleche.png" alt="icone fleche" />

                <p>Passionnés de voyage et de surf, c’est après avoir réalisé plusieurs trips en Espagne, Portugal,<br> Maroc, Afrique du Sud et du Mexique, que nous avons découvert le Nicaragua.<br> Devant la méconnaissance de ce pays en Europe, et après y avoir séjourné plusieurs fois,<br> nous avons décidé de créer Zephyr Blog afin de rendre cette destination plus accessible.</p>
            </section>
            <div class="philosophie">
                <h2>NOTRE PHILOSOPHIE</h2>
            </div>

            <section class="c_section_carte">
                <div class="container_sct_original">
                    <div class='banner-img'>
                    </div>
                    <img src='./public/image/voyagez.png' alt='profile image' class="profile-img">
                    <p class="name">Préparer vos voyages</p>
                    <p class="description">Passionnés de voyage et de découverte, on souhaite vous faire partager notre experience pour faciliter vos futurs séjours.</p>

                </div>
                <div class="container_sct_original">
                    <div class='banner-img'>
                    </div>
                    <img src='./public/image/surfez.png' alt='profile image' class="profile-img">
                    <p class="name">Des articles pour les passionnés de surf</p>
                    <p class="description">Plus qu'une passion, un style de vie. On part au bout du monde pour surfer des vagues parfaites dans des cadres paradisiaques.</p>

                </div>
                <div class="container_sct_original">
                    <div class='banner-img'>
                    </div>
                    <img src='./public/image/decouvrez.png' alt='profile image' class="profile-img">
                    <p class="name">Mieux connaître ce pays méconnu</p>
                    <p class="description">Pour nous, partir surfer à l'étranger ne signifie pas rester sur la plage mais d'abord découvrir une culture, rencontrer et partager.</p>

                </div>


            </section>
            <section class="c_section_transition">
                <p>NOS ARTICLES</p>
            </section>

            <section class="c_section_carte">
                <?php foreach ($get3Articles as $article) {
                ?>

                    <div class="container_sct">
                        <a href="./article.php?id=<?= $article['id'] ?>">
                            <div style="         position: absolute;
                background-image: url('<?= $article['image'] ?>');
                height: 10rem;
                width: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;">
                            </div>
                            <img src='<?= $article['image'] ?>' alt='profile image' class="profile-img">
                            <p class="titre"><?= $article['titre'] ?></p>
                            <p class="description"><?= $article['description'] ?></p>
                            <a href="./article.php?id=<?= $article['id'] ?>">Lire la suite</a>
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