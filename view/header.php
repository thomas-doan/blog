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






<header class="c_header">

    <img id="img_background_header" src="./public/image/mer.jpg" alt="background home" />
    <nav class="c_nav">
        <ul id="navbar" class="nav">


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
            <p id="name">ZEPHYR <span>BLOG</span> </p>
        </a>
        <a>
            <p>Notre histoire</p>
        </a>

    </div>
</header>