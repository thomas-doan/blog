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

if (Securite::estConnecte() && !Securite::estAdministrateur()) {
    header('Location:index.php');
}

$administrateurController = new AdministrateurController();
$utilisateurController = new UtilisateurController();
$utilisateurs =  $administrateurController->droits();




if (!empty($_POST['prenom'])) {
    $administrateurController->validation_modificationAdminPrenom($_POST['login'], $_POST['prenom']);
}


if (!empty($_POST['nom'])) {
    $administrateurController->validation_modificationAdminNom($_POST['login'], $_POST['nom']);
}

if (!empty($_POST['mail'])) {
    $administrateurController->validation_modificationAdminMail($_POST['login'], $_POST['mail']);
}

if (!empty($_POST['role'])) {
    $administrateurController->validation_modificationRole($_POST['login'], $_POST['role']);
}



if (!empty($_POST['login'])) {
    $login = Securite::secureHTML($_POST['login']);
    $administrateurController->validation_modificationAdminLogin($_POST['id'], $login);
}

if (!empty($_POST['login_sup'])) {
    $utilisateurController->suppression_compte_panel_admin($_POST['login_sup']);
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


        <div class="container_diff">
            <?php require_once('./view/header_spe.php'); ?>
            <div class="text-center">


                <h1>Gestion des droits des utilisateurs</h1>
                <a href="./admin_creer_user.php"> <button class="btn btn-success" id="btnValidModifLogin" type="submit">Créer utilisateur
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                        </svg>
                    </button></a>

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Login</th>
                                <th>Prenom</th>
                                <th>Nom</th>
                                <th>Email</th>

                                <th>Rôle</th>
                                <th>supprimer user</th>

                            </tr>
                            <?php foreach ($utilisateurs as $utilisateur) {
                                if ($utilisateur['login'] !== $_SESSION['profil']["login"] && $utilisateur['login'] !== "utilisateur supprimé") { ?>
                                    <div class="text-center">

                                    </div>

                                    <tr>
                                        <td><?= $utilisateur['login'] ?>

                                            <div>
                                                <form method="POST" action="administration_user.php">
                                                    <div class="row justify-content-center">

                                                        <div class="col-5">
                                                            <input type="hidden" name="id" value="<?= $utilisateur['id'] ?>" />
                                                            <input type="text" class="form-control" name="login" value="<?= $utilisateur['login'] ?>" required />

                                                            <button class="btn btn-success" id="btnValidModifLogin" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>


                                                        </div>
                                                    </div>
                                                </form>
                                            </div>



                                        </td>


                                        <td><?= $utilisateur['prenom'] ?>

                                            <div>
                                                <form method="POST" action="administration_user.php">
                                                    <div class=" row d-flex justify-content-center">
                                                        <div class="col-6">
                                                            <input type="hidden" name="login" value="<?= $utilisateur['login'] ?>" />
                                                            <input type="text" class="form-control" name="prenom" value="<?= $utilisateur['prenom'] ?>" required />

                                                            <button class="btn btn-success" id="btnValidModifPrenom" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td><?= $utilisateur['nom'] ?>

                                            <div>
                                                <form method="POST" action="administration_user.php">
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-6">
                                                            <input type="hidden" name="login" value="<?= $utilisateur['login'] ?>" />
                                                            <input type="text" class="form-control" name="nom" value="<?= $utilisateur['nom'] ?>" required />

                                                            <button class="btn btn-success" id="btnValidModifPrenom" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        </td>
                                        <td><?= $utilisateur['mail'] ?>

                                            <div>
                                                <form method="POST" action="administration_user.php">
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-8">
                                                            <input type="hidden" name="login" value="<?= $utilisateur['login'] ?>" />
                                                            <input type="text" class="form-control" name="mail" value="<?= $utilisateur['mail'] ?>" required />


                                                            <button class="btn btn-success" id="btnValidModifPrenom" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>



                                        </td>

                                        <td>
                                            <?php if ($utilisateur['id_droits'] === "3") : ?>
                                                <?= $utilisateur['id_droits'] ?>
                                            <?php else : ?>
                                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

                                                <form method="POST" action="administration_user.php">
                                                    <input type="hidden" name="login" value="<?= $utilisateur['login'] ?>" />
                                                    <select class="form-select" name="role" onchange="confirm('confirmez vous la modification ?') ? submit() : document.location.reload()">
                                                        <option value="1" <?= $utilisateur['id_droits'] === "1" ? "selected" : "" ?>>Utilisateur</option>
                                                        <option value="2" <?= $utilisateur['id_droits'] === "2" ? "selected" : "" ?>>Moderateur</option>
                                                        <option value="3" <?= $utilisateur['id_droits'] === "3" ? "selected" : "" ?>>Administrateur</option>
                                                    </select>
                                                </form>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <form method="POST" action="administration_user.php">
                                                <input type="hidden" name="login_sup" value="<?= $utilisateur['login'] ?>" />
                                                <button id="btnSupCompte" class="btn btn-danger">X</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once('./view/gestion_erreur.php'); ?>


        <?php require_once('./view/footer.php'); ?>
    </div>
</body>

</html>