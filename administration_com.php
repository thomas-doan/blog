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
$commentaires =  $administrateurController->coms();


if (!empty($_POST['commentaire'])) {
    $administrateurController->validation_modificationAdminCom($_POST['id'], $_POST['commentaire']);
}

if (!empty($_POST['idSupprCom'])) {
    $administrateurController->validation_modificationSupprAdminCom($_POST['idSupprCom']);
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


                <h1>Gestion des droits des commentaires</h1>
                <a href="./admin_creer_com.php"> <button class="btn btn-success" id="btnValidModifLogin" type="submit">Créer un commentaire
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        </svg>
                    </button></a>

                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>commentaire</th>
                                <th>login</th>
                                <th>supprimer</th>



                            </tr>
                            <?php foreach ($commentaires as $com) {
                            ?>
                                <div class="text-center">
                                    <tr>

                                        <td><?= $com['id'] ?></td>



                                        <td><?= $com['commentaire'] ?>

                                            <div>
                                                <form method="POST" action="administration_com.php">
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-4">
                                                            <input type="hidden" name="id" value="<?= $com['id'] ?>" />
                                                            <input type="text" class="form-control" name="commentaire" value="<?= $com['commentaire'] ?>" required />

                                                            <button class="btn btn-success" id="btnValidModifComm" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>

                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </td>

                                        <td><?= $com['login'] ?>
                                        </td>


                                        <td>

                                            <form method="POST" action="administration_com.php">
                                                <input type="hidden" name="idSupprCom" value="<?= $com['id'] ?>" />
                                                <button id="btnSupCompte" class="btn btn-danger">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                </div>


                            <?php }
                            ?>
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