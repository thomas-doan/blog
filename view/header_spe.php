<?php


require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$administrateurController = new AdministrateurController();
?>






<header class="c_header_login">

    <img id="img_background_header" src="./public/image/mer.jpg" alt="background home" />
    <nav class="c_nav">
        <ul id="navbar_spe" class="nav_spe">

            <li><a href="../blog/index.php">Notre histoire</a></li>
            <li><a href="../blog/articles.php">Articles</a></li>
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
                <div class="deroulant">
                    <button>
                        Administration
                    </button>
                    <div class="content">
                        <a href="../blog/administration_user.php">Gérer les droits</a>
                        <a href="../blog/administration_user.php">Gérer les commentaires</a>
                        <a href="../blog/administration_user.php">Gérer les articles</a>
                    </div>

                </div>
            <?php endif; ?>

            <a class="icon" onclick="myFunction()">&#9776;</a>

        </ul>
        <script>
            function myFunction() {
                var x = document.getElementById("navbar_spe");
                if (x.className === "nav_spe") {
                    x.className += " responsive";
                } else {
                    x.className = "nav_spe";
                }
            }
        </script>

    </nav>






</header>