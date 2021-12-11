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






<header class="c_header_login">

    <img id="img_background_header" src="./public/image/mer.jpg" alt="background home" />
    <nav class="c_nav">
        <ul id="navbar_spe" class="nav_spe">

            <li><a class="logo" href="../blog/index.php">Zephyr</a></li>
            <div class="menu-deroulant">
                <li><a href="#">Articles</a>
                    <ul>
                        <?php foreach ($getCategories as $nomCategories) { ?>
                            <li><a class="lien" href="./articles.php?page=1&categorie=<?= $nomCategories['nom'] ?>">Cat : <?= $nomCategories['nom'] ?></a></li>
                        <?php } ?>
                        <li><a class="lien" href="../blog/articles.php">Tous les articles</a></li>


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
                <div class="menu-deroulant">
                    <li><a href="#">Administration</a>
                        <ul>
                            <li> <a href="../blog/administration_user.php">Gérer les droits</a></li>
                            <li> <a href="../blog/administration_user.php">Gérer les commentaires</a></li>
                            <li> <a href="../blog/administration_user.php">Gérer les articles</a></li>
                            <li><a href="../blog/articles.php">Tous les articles</a></li>


                        </ul>
                    </li>
                </div>
            <?php endif; ?>

            <a class="icon_spe" onclick="myFunction_spe()">&#9776;</a>

        </ul>
        <script>
            function myFunction_spe() {
                var x = document.getElementById("navbar_spe");
                if (x.className === "nav_spe") {
                    x.className += " responsive_spe";
                } else {
                    x.className = "nav_spe";
                }
            }
        </script>

    </nav>






</header>