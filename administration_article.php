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
$articles =  $administrateurController->liste_articles();
$getLogin = $administrateurController->droits();
$getcatadmin = $administrateurController->recup_cats();



if (!empty($_POST['titre'])) {
    $titre_article = Securite::secureHTML($_POST['titre']);
    $administrateurController->validation_modificationAdminArticleTitre($_POST['id'], $titre_article);
}

if (!empty($_POST['login'])) {
    $login_article = Securite::secureHTML($_POST['login']);
    $administrateurController->validation_modificationAdminArticleLogin($_POST['id'], $login_article);
}


if (!empty($_POST['categorie'])) {
    $categorie_article = Securite::secureHTML($_POST['categorie']);
    $administrateurController->validation_modificationAdminArticleCategorie($_POST['id'], $categorie_article);
}

if (!empty($_POST['actuArticle'])) {
    $msg_article = Securite::secureHTML($_POST['actuArticle']);
    $administrateurController->validation_modificationAdminArticleContenu($_POST['id'], $msg_article);
}

if (!empty($_POST['actuArticle'])) {
    $msg_article = Securite::secureHTML($_POST['actuArticle']);
    $administrateurController->validation_modificationAdminArticleContenu($_POST['id'], $msg_article);
}


if (!empty($_POST['idSupprArt'])) {
    $administrateurController->validation_modificationSupprAdminArt($_POST['idSupprArt']);
}



if (!empty($_POST['actuDescription'])) {
    $msg_description = Securite::secureHTML($_POST['actuDescription']);
    $administrateurController->validation_modificationAdminArticleDescription($_POST['id'], $msg_description);
}



if (isset($_FILES['file'])) {
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];

    $tabExtension = explode('.', $name);

    $extension = strtolower(end($tabExtension));

    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $maxSize = 400000;

    if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {

        $uniqueName = uniqid('', true);
        $msg_description = Securite::secureHTML($_POST['add_nom_categorie']);
        $file = "$msg_description" . $uniqueName  . "." . $extension;

        $nom = './public/image/' . "$msg_description" . $uniqueName  . "." . $extension;
        define('SITE_ROOT', realpath(dirname(__FILE__)));
        move_uploaded_file($tmpName, SITE_ROOT . '/public/image/' . $file);

        $administrateurController->admin_creation_categorie($nom, $msg_description);
    }
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

                <?php require_once('./view/gestion_erreur.php'); ?>
                <h1>Gestion des articles</h1>
                <a href="./admin_creer_com.php"> <button class="btn btn-success" id="btnValidModifLogin" type="submit">Créer un article
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                        </svg>
                    </button></a>
                <div class="creation_categorie_admin">
                    <p>Créer une categorie : </p>
                    <form action="administration_article.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="add_nom_categorie" value="" placeholder="nom de votre categorie" />

                        <input type="file" name="file">

                        <button type="submit"> Valider

                        </button>

                    </form>
                </div>

                </button></a>

                <div>
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Categorie</th>
                                <th>Titre</th>
                                <th>description</th>
                                <th>Article</th>
                                <th>Créateur</th>
                                <th>Supprimer</th>

                            </tr>



                            <?php foreach ($articles as $article) {
                            ?>
                                <div class="text-center">
                                    <tr>


                                        <td><?= $article['nom'] ?>

                                            <div>
                                                <form method="POST" action="administration_article.php">
                                                    <div class="row d-flex justify-content-center">
                                                        <input type="hidden" name="id" value="<?= $article['id'] ?>" />
                                                        <div class="col-4">

                                                            <select name="categorie">

                                                                <?php foreach ($getcatadmin as $cat) { ?>
                                                                    <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>

                                                                <?php
                                                                } ?>
                                                            </select> <button class="col-2 btn btn-success" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>

                                                        </div>

                                                    </div>
                                                </form>

                                            </div>


                                        </td>

                                        <td><?= $article['titre'] ?>

                                            <div>
                                                <form method="POST" action="administration_article.php">
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-4">
                                                            <input type="hidden" name="id" value="<?= $article['id'] ?>" />
                                                            <input type="text" class="form-control" name="titre" value="<?= $article['titre'] ?>" required />

                                                            <button class="col-2 btn btn-success" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>

                                                        </div>

                                                    </div>
                                                </form>

                                            </div>


                                        </td>

                                        <td><?= $article['description'] ?>

                                            <div>
                                                <form method="POST" action="administration_article.php">
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-10">
                                                            <input type="hidden" name="id" value="<?= $article['id'] ?>" />
                                                            <textarea type="text" class="form-control" name="actuDescription" required /> <?= $article['description'] ?> </textarea>

                                                            <button class="col-2 btn btn-success" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>

                                                        </div>

                                                    </div>
                                                </form>

                                            </div>

                                        </td>



                                        <td><?= $article['article'] ?>

                                            <div>
                                                <form method="POST" action="administration_article.php">
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-10">
                                                            <input type="hidden" name="id" value="<?= $article['id'] ?>" />
                                                            <textarea type="text" class="form-control" name="actuArticle" required /> <?= $article['article'] ?> </textarea>

                                                            <button class="col-2 btn btn-success" type="submit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                                                </svg>
                                                            </button>

                                                        </div>

                                                    </div>
                                                </form>

                                            </div>

                                        </td>




                                        <td><?= $article['login'] ?>

                                            <div>
                                                <form method="POST" action="administration_article.php">
                                                    <div class="row d-flex justify-content-center">
                                                        <input type="hidden" name="id" value="<?= $article['id'] ?>" />
                                                        <div class="col-4">

                                                            <select name="login">

                                                                <?php foreach ($getLogin as $login) {
                                                                    if ($login['id_droits'] == 3 || $login['id_droits'] == 2) {

                                                                ?>
                                                                        <option value="<?= $login['id'] ?>"><?= $login['login'] ?></option>

                                                                <?php
                                                                    }
                                                                } ?>
                                                            </select> <button class="col-2 btn btn-success" type="submit">
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

                                            <form method="POST" action="administration_article.php">
                                                <input type="hidden" name="idSupprArt" value="<?= $article['id'] ?>" />
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



        <?php require_once('./view/footer.php'); ?>
    </div>
</body>

</html>