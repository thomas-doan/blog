<?php
session_start();

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();

/* ******PAGINATION******* */
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {


    $currentPage = 1;
}
$nb = $visiteurController->nbArticles();
$nbArticles = (int) $nb['nb_articles'];
$parPage = 4;
$pages = ceil($nbArticles / $parPage);
$premier = ($currentPage * $parPage) - $parPage;



$getArticles =  $visiteurController->tousLesArticles($premier, $parPage);
$getCategories =  $visiteurController->get_categories();

/* var_dump($get3Articles); */

if (isset($_GET['categorie']) && !empty($_GET['categorie']) && isset($_GET['page']) && !empty($_GET['page'])) {

    $currentPage = (int) strip_tags($_GET['page']);
    $nb = $visiteurController->nb_filtre_categorie($_GET['categorie']);
    $nbArticles = (int) $nb['nb_articles'];

    $parPage = 4;

    $pages = ceil($nbArticles / $parPage);
    $premier = ($currentPage * $parPage) - $parPage;
    $getArticles =  $visiteurController->get_filter_categorie($_GET['categorie'], $premier, $parPage);
    $cat = $_GET['categorie'];
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

    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <title>Zephyr Blog articles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>

    <div class="container_diff">
        <?php require_once('./view/header_spe.php'); ?>

        <main class="c_main">

            <section class="c_section_transition">
                <p data-aos="fade-right" data-aos-duration="2000">NOS ARTICLES</p>
            </section>

            <div class="afficher_articles">
                <div class="menu_sticky_cat">

                    <ul class="menu-accordeon">
                        <?php if (isset($_GET['categorie'])) { ?>
                            <li><a href="#">Categorie : <?= $_GET['categorie'] ?></a>
                            <?php } else { ?>
                            <li><a href="#">Categorie</a>
                            <?php } ?>

                            <ul>
                                <?php foreach ($getCategories as $nomCategories) {
                                    if ($nomCategories['nom'] !== "categorie suppr") { ?>
                                        <li><a href="./articles.php?page=1&categorie=<?= $nomCategories['nom'] ?>"><?= $nomCategories['nom'] ?></a></li>
                                <?php }
                                } ?>
                                <li><a href="./articles.php">Tous les articles</a></li>
                            </ul>
                            </li>

                    </ul>
                </div>
                <section class="c_section_carte">

                    <?php foreach ($getArticles as $articles) {
                    ?>

                        <div class="container_sct">
                            <a href="./article.php?id=<?= $articles['id'] ?>">
                                <div style="position: absolute;
                            background-image: url('<?= $articles['image'] ?>');

                            height: 10rem;
                            width: 100%;
                            background-position: center;
                            background-repeat: no-repeat;
                            background-size: cover;">
                                </div>
                                <img src='<?= $articles['image'] ?>' alt='profile image' class="profile-img">
                                <p class="name" data-aos="fade-right" data-aos-duration="1000"><?= $articles['titre'] ?></p>
                                <p class="description" data-aos="fade-right" data-aos-duration="1000"><?= $articles['description'] ?></p>
                                <a href="./article.php?id=<?= $articles['id'] ?>">Lire la suite</a>
                            </a>
                        </div>

                    <?php } ?>

                </section>
            </div>

            <div class="nav_pagination">
                <ul class="pagination">
                    <?php if (isset($_GET['categorie'])) { ?>
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="./articles.php?page=<?= $currentPage - 1 ?>&categorie=<?= $_GET['categorie'] ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for ($page = 1; $page <= $pages; $page++) : ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="./articles.php?page=<?= $page ?>&categorie=<?= $_GET['categorie'] ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="./articles.php?page=<?= $currentPage + 1 ?>&categorie=<?= $_GET['categorie'] ?>" class="page-link">Suivante</a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="./articles.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for ($page = 1; $page <= $pages; $page++) : ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="./articles.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="./articles.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <section class="c_section_transition">
                <span style="font-size: 3rem; color: rgb(181, 150, 104);">
                    <i class="fa fa-paper-plane"></i>
                </span>

                <p id="abonnement" data-aos="fade-right" data-aos-duration="2000">Nos aventures !</p>
                <form action="#">
                    <input type="text" name="" value="" placeholder="nous suivre par email" required="" data-aos="fade-right" data-aos-duration="2000">
                    <input type="submit" name="" value="Envoyer" data-aos="fade-right" data-aos-duration="2000">
                </form>
            </section>



        </main>
        <?php require_once('./view/footer.php'); ?>


    </div>
    <script>
        AOS.init({
            duration: 2000,
        })
    </script>
</body>

</html>