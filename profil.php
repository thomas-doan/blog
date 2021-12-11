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


if (!empty($_POST['login'])) {
    $login = Securite::secureHTML($_POST['login']);
    $utilisateurController->validation_modificationLogin($login);
}

if (!empty($_POST['mail'])) {
    $mail = Securite::secureHTML($_POST['mail']);
    $utilisateurController->validation_modificationMail($mail);
}

if (!empty($_POST['prenom'])) {
    $prenom = Securite::secureHTML($_POST['prenom']);
    $utilisateurController->validation_modificationPrenom($prenom);
}

if (!empty($_POST['nom'])) {
    $nom = Securite::secureHTML($_POST['nom']);
    $utilisateurController->validation_modificationNom($nom);
}

if (!empty($_POST['id'])) {
    $utilisateurController->suppressionCompte();
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
    <title>Zephyr Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



</head>

<body>




    <div class="general-main">
        <div class="containe d-flex h-100">

            <div class="container_diff">
                <?php require_once('./view/header_spe.php'); ?>
                <div class="container_profil">
                    <div class="text-center">
                        <h3>Profil de <?= $utilisateur['login'] ?></h3>
                        <div>

                            <div id="login">
                                Login : <?= $utilisateur['login'] ?>
                            </div>

                            <div id="modificationLogin" class="">
                                <form method="POST" action="profil.php">
                                    <div class="row">

                                        <div class="col-8">
                                            <input type="text" class="form-control" name="login" value="<?= $utilisateur['login'] ?>" required />
                                        </div>
                                        <div class="col-4 ">
                                            <button class="btn btn-success" id="btnValidModifLogin" type="submit">
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
                                <form method="POST" action="profil.php">
                                    <div class="row">

                                        <div class="col-8">
                                            <input type="mail" class="form-control" name="mail" value="<?= $utilisateur['mail'] ?>" required />
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-success" id="btnValidModifMail" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div id="prenom">
                                Prenom : <?= $utilisateur['prenom'] ?>
                            </div>


                            <div id="modificationPrenom" class="">
                                <form method="POST" action="profil.php">
                                    <div class="row">

                                        <div class="col-8">
                                            <input type="text" class="form-control" name="prenom" value="<?= $utilisateur['prenom'] ?>" required />
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-success" id="btnValidModifPrenom" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div id="nom">
                                Nom : <?= $utilisateur['nom'] ?>
                            </div>



                            <div id="modificationNom" class="">
                                <form method="POST" action="profil.php">
                                    <div class="row">

                                        <div class="col-8">
                                            <input type="text" class="form-control" name="nom" value="<?= $utilisateur['nom'] ?>" required />
                                        </div>
                                        <div class="col-4">
                                            <button class="btn btn-success" id="btnValidModifNom" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>




                            <div>
                                <a href="./modif_mdp.php" class="btn btn-warning">Changer le mot de passe</a>
                                <form method="POST" action="profil.php">
                                    <input type="hidden" name="id" value="<?= $utilisateur['id'] ?>" />
                                    <button id="btnSupCompte" class="btn btn-danger">Supprimer son compte</button>
                                </form>
                            </div>

                        </div>
                        <?php require_once('./view/gestion_erreur.php'); ?>

                    </div>
                </div>



            </div>
        </div>
        <?php require_once('./view/footer.php'); ?>

    </div>
</body>

</html>