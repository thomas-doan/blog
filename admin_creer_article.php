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
} elseif (Securite::estConnecte() && !Securite::estAdministrateur()) {
    header('Location:index.php');
}



$getLogin = $administrateurController->droits();
$get_creer_cat_admin = $administrateurController->recup_cats();


if (isset($_POST['id']) && isset($_POST['id_utilisateur']) && isset($_POST['message']) && isset($_POST['titre']) && isset($_POST['description'])) {
    $message = Securite::secureHTML($_POST['message']);
    $titre = Securite::secureHTML($_POST['titre']);
    $description = Securite::secureHTML($_POST['description']);
    $administrateurController->admin_creer_article($_POST['id'], $_POST['id_utilisateur'], $message, $titre, $description);
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
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="general-main">


        <div class="container_diff">

            <?php require_once('./view/header_spe.php'); ?>
            <div class="container_creer_com">


                <div class="container_com_item">
                    <h1>Créer des articles</h1>
                    <div class="com">

                        <form method="POST" action="admin_creer_article.php">


                            <div class="menu_crea_article">
                                <label for="article-select">Choisir categorie:</label>
                                <select name="id">

                                    <?php foreach ($get_creer_cat_admin as $list_cat) {
                                        if ($list_cat['nom'] !== 'categorie suppr') {


                                    ?>
                                            <option value="<?= $list_cat['id'] ?>"><?= $list_cat['nom'] ?></option>

                                    <?php
                                        }
                                    } ?>
                                </select>
                                <label for="article-select">Choisir un créateur:</label>
                                <select name="id_utilisateur">

                                    <?php foreach ($getLogin as $login) {
                                        if ($login['id_droits'] == 3 || $login['id_droits'] == 2) {


                                    ?>
                                            <option value="<?= $login['id'] ?>"><?= $login['login'] ?></option>

                                    <?php
                                        }
                                    } ?>
                                </select>
                                <textarea name="titre" placeholder="Votre titre" require></textarea>
                                <textarea name="description" placeholder="Votre description" require></textarea>
                            </div>
                            <textarea name="message" placeholder="Poster votre commentaire" require></textarea>
                            <button class="btn btn-primary" type="submit">Envoyer</button>

                        </form>
                        <?php require_once('./view/gestion_erreur.php'); ?>


                    </div>

                </div>



            </div>




        </div>

        <?php require_once('./view/footer.php'); ?>
    </div>
    </div>


</body>

</html>