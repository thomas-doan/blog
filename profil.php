<?php
session_start();

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");




if (!isset($_SESSION['profil']['id'])) {
    header('Location:index.php');
}
$utilisateurController = new UtilisateurController();
$utilisateur =  $utilisateurController->profil();

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




    <div class="general-main">


        <div class="container">
            <?php require_once('./view/header.php'); ?>
            <main class="c_main">

                <h3>Profil de <?= $utilisateur['login'] ?></h3>


                <div id="login">
                    Login : <?= $utilisateur['login'] ?>
                </div>

                <div id="modificationLogin" class="">
                    <form method="POST" action="">
                        <div class="">
                            <label for="login" class="">Modification</label>
                            <div class="">
                                <input type="text" class="" name="login" value="<?= $utilisateur['login'] ?>" />
                            </div>
                            <div class="">
                                <button class="" id="btnValidModifLogin" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div id="mail">
                    Mail : <?= $utilisateur['mail'] ?>
                </div>


                <div id="modificationMail" class="">
                    <form method="POST" action="">
                        <div class="">
                            <label for="mail" class="">Modification</label>
                            <div class="">
                                <input type="mail" class="" name="mail" value="<?= $utilisateur['mail'] ?>" />
                            </div>
                            <div class="">
                                <button class="" id="btnValidModifMail" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div id="prenom">
                    prenom : <?= $utilisateur['prenom'] ?>
                </div>


                <div id="modificationPrenom" class="">
                    <form method="POST" action="">
                        <div class="row">
                            <label for="prenom" class="">Modification</label>
                            <div class="col-8">
                                <input type="text" class="" name="prenom" value="<?= $utilisateur['prenom'] ?>" />
                            </div>
                            <div class="col-2">
                                <button class="" id="btnValidModifPrenom" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <div id="nom">
                    nom : <?= $utilisateur['nom'] ?>
                </div>





                <div id="modificationNom" class="">
                    <form method="POST" action="">
                        <div class="row">
                            <label for="nom" class="">Modification</label>
                            <div class="">
                                <input type="text" class="" name="nom" value="<?= $utilisateur['nom'] ?>" />
                            </div>
                            <div class="">
                                <button class="" id="btnValidModifNom" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                        <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>










                <div>
                    <a href="" class="">Changer le mot de passe</a>
                    <button id="btnSupCompte" class="btn btn-danger">Supprimer son compte</button>
                </div>
                <div id="suppressionCompte" class="">
                    <div class="">
                        Veuillez confirmer la suppression du compte.
                        <br />
                        <a href="" class="">Je Souhaite supprimer mon compte définitivement !</a>
                    </div>
                </div>


            </main>


        </div>



        <?php require_once('./view/footer.php'); ?>
</body>

</html>