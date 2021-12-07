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
        <ul>
            <li><a href="http://localhost:9999/blog/index.php">Notre histoire</a></li>

            <li><a href="contact.asp">Articles</a></li>
            <?php if (!Securite::estConnecte()) : ?>
                <li>
                    <a href="http://localhost:9999/blog/login.php">Se connecter</a>
                </li>
                <li>
                    <a href="http://localhost:9999/blog/inscription.php">Créer compte</a>
                </li>
            <?php else : ?>
                <li>
                    <a href="http://localhost:9999/blog/profil.php">Profil</a>
                </li>
                <form method="POST" action="login.php">
                    <li>
                        <a href="http://localhost:9999/blog/logout.php">Se déconnecter</a>
                    </li>
                </form>
            <?php endif; ?>
            <?php if (Securite::estConnecte() && Securite::estAdministrateur()) : ?>
                <li>
                    <a href="#">
                        Administration
                    </a>
                    <ul>
                        <li><a href="">Gérer les droits</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>


    </nav>
    <div class="titre_blog">
        <p id="name">ZEPHYR <span>BLOG</span> </p>
        <p>Voir nos articles</p>
    </div>
</header>