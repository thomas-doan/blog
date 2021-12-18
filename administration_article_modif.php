<?php
session_start();

require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$administrateurController = new AdministrateurController();



if (!Securite::estConnecte()) {


    header('Location:index.php');
}
if (Securite::estUtilisateur()) {
    header('Location:index.php');
}


if (isset($_GET['id']) or is_numeric($_GET['id'])) {

    extract($_GET);
    $id = strip_tags($id);
    /* ------ affichage article -------- */
    $data_article = $visiteurController->getArticlebyId($id);

    /*     $time = $data_article['date'];
    $date = date_create("$time");
    $date_formate = date_format($date, 'j F Y'); */
    /* --------- affichage commentaire par id  ------- */
}


if (!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['article'])) {
    $administrateurController->validation_modificationAdminArticlelayout($id, $_POST['titre'], $_POST['article'], $_POST['description']);
    /*     $administrateurController->validation_modificationAdminArticleTitre($id, $_POST['titre']);
    $administrateurController->validation_modificationAdminArticleContenu($id, $_POST['article']);
    $administrateurController->validation_modificationAdminArticleDescription($id, $_POST['description']); */
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/css/login.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <title>Zephyr Blog admin modification article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>

    <div class="general-main">


        <div class="container_diff">


            <?php require_once('./view/header_spe.php'); ?>
            <div class="container_creer_com">


                <div class="container_com_item">
                    <?php require_once('./view/gestion_erreur.php'); ?>
                    <h1>modifier article</h1>

                    <div class="com">

                        <form method="POST" action="administration_article_modif.php?id=<?= $data_article['id'] ?>" enctype="multipart/form-data">

                            <div class="menu_crea_article">
                                <p>Titre</p>
                                <textarea name="titre">  <?= $data_article['titre']  ?></textarea>
                                <p>description</p>
                                <textarea name="description"> <?= $data_article['description'] ?></textarea>
                                <p>contenu</p>
                                <textarea name="article" i> <?= $data_article['article'] ?></textarea>


                            </div>

                            </textarea>
                            <button class="btn btn-primary" type="submit">Envoyer</button>

                        </form>



                    </div>

                </div>



            </div>




        </div>

        <?php require_once('./view/footer.php'); ?>
    </div>
    </div>
    <script>
        AOS.init({
            duration: 2000,
        })
    </script>

</body>

</html>