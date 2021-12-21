<?php
session_start();


require_once(__DIR__ . "/../controllers/Toolbox.class.php");
require_once(__DIR__ . "/../controllers/Securite.class.php");
require_once(__DIR__ . "/../controllers/Visiteur/Visiteur.controller.php");
require_once(__DIR__ . "/../controllers/Utilisateur/Utilisateur.controller.php");
require_once(__DIR__ . "/../controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$administrateurController = new AdministrateurController();

if (!isset($_SESSION['profil']['id'])) {
    header('Location:index.php');
}

if (session_destroy()) {
    $utilisateurController->deconnexion();
}
