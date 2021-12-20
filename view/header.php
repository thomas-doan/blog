<?php


require_once(__DIR__ . "/../controllers/Toolbox.class.php");
require_once(__DIR__ . "/../controllers/Securite.class.php");
require_once(__DIR__ . "/../controllers/Visiteur/Visiteur.controller.php");
require_once(__DIR__ . "/../controllers/Utilisateur/Utilisateur.controller.php");
require_once(__DIR__ . "/../controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$administrateurController = new AdministrateurController();
$getCategories =  $visiteurController->get_categories();
?>






<header class="c_header">


    <img id="img_background_header" src="./public/image/mer.jpg" alt="background home" data-aos="fade-zoom-in" data-aos-easing="ease-in-back" data-aos-duration="3000" data-aos-delay="3500" data-aos-offset="0" />
    <nav class="c_nav">
        <ul id="navbar" class="nav">



            <div class="menu_deroulant_index">
                <li><a href="#">Articles</a>
                    <ul>
                        <?php foreach ($getCategories as $nomCategories) {
                            if ($nomCategories['nom'] !== "categorie suppr") { ?>
                                <li><a href="./view/articles.php?page=1&categorie=<?= $nomCategories['nom'] ?>">Cat : <?= $nomCategories['nom'] ?></a></li>
                        <?php }
                        } ?>
                        <li><a href="./view/articles.php">Tous les articles</a></li>


                    </ul>
                </li>
            </div>


            <?php if (!Securite::estConnecte()) : ?>
                <li>
                    <a href="./view/login.php">Se connecter</a>
                </li>
                <li>
                    <a href="./view/inscription.php">Créer compte</a>
                </li>
            <?php else : ?>
                <li>
                    <a href="./view/profil.php">Profil</a>
                </li>
                <form method="POST" action="login.php">
                    <li>
                        <a href="./view/logout.php">Se déconnecter</a>
                    </li>
                </form>
            <?php endif; ?>
            <?php if (Securite::estConnecte() && Securite::estAdministrateur()) : ?>

                <div class="menu_deroulant_index">
                    <li><a href="#">Administration</a>
                        <ul>
                            <li> <a href="./view/administration_user.php">Gérer les droits</a></li>
                            <li> <a href="./view/administration_com.php">Gérer les commentaires</a></li>
                            <li> <a href="./view/administration_article.php">Gérer les articles</a></li>
                            <li><a href="./view/administration_categorie.php">Gérer les categories</a></li>


                        </ul>
                    </li>
                </div>
            <?php endif; ?>

            <?php if (Securite::estConnecte() && Securite::estModerateur()) {  ?>
                <div class="menu_deroulant_index">
                    <li><a href="#">Administration</a>
                        <ul>

                            <li> <a href="./view/administration_article.php">Gérer les articles</a></li>


                        </ul>
                    </li>
                </div>

            <?php  }
            ?>

            <a class="icon" onclick="myFunction()">&#9776;</a>

        </ul>
        <script>
            function myFunction() {
                var x = document.getElementById("navbar");
                if (x.className === "nav") {
                    x.className += " responsive";
                } else {
                    x.className = "nav";
                }
            }
        </script>

    </nav>
    <div class="titre_blog">
        <a href="./index.php">
            <p id="name" data-aos="fade-right" data-aos-duration="3000">ZEPHYR <span data-aos="fade-up" data-aos-duration="6000" data-aos-delay="8000">BLOG</span> </p>
        </a>
        <a>
            <p data-aos="fade-down" data-aos-duration="5000">Notre histoire</p>
        </a>

    </div>
</header>