<?php


require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
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
                                <li><a href="./articles.php?page=1&categorie=<?= $nomCategories['nom'] ?>">Cat : <?= $nomCategories['nom'] ?></a></li>
                        <?php }
                        } ?>
                        <li><a href="../blog/articles.php">Tous les articles</a></li>


                    </ul>
                </li>
            </div>


            <?php if (!Securite::estConnecte()) : ?>
                <li>
                    <a href="../blog/login.php">Se connecter</a>
                </li>
                <li>
                    <a href="../blog/inscription.php">Créer compte</a>
                </li>
            <?php else : ?>
                <li>
                    <a href="../blog/profil.php">Profil</a>
                </li>
                <form method="POST" action="login.php">
                    <li>
                        <a href="../blog/logout.php">Se déconnecter</a>
                    </li>
                </form>
            <?php endif; ?>
            <?php if (Securite::estConnecte() && Securite::estAdministrateur()) : ?>

                <div class="menu_deroulant_index">
                    <li><a href="#">Administration</a>
                        <ul>
                            <li> <a href="../blog/administration_user.php">Gérer les droits</a></li>
                            <li> <a href="../blog/administration_com.php">Gérer les commentaires</a></li>
                            <li> <a href="../blog/administration_article.php">Gérer les articles</a></li>
                            <li><a href="../blog/administration_categorie.php">Gérer les categories</a></li>


                        </ul>
                    </li>
                </div>
            <?php endif; ?>

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
        <a href="../blog/index.php">
            <p id="name" data-aos="fade-right" data-aos-duration="3000">ZEPHYR <span data-aos="fade-up" data-aos-duration="6000" data-aos-delay="8000">BLOG</span> </p>
        </a>
        <a>
            <p data-aos="fade-right" data-aos-duration="3000">Notre histoire</p>
        </a>

    </div>
</header>