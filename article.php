<?php
session_start();


require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();

if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('Location: index.php');
} else {
    extract($_GET);
    $id = strip_tags($id);
    /* ------ affichage article -------- */
    $data_article = $visiteurController->getArticlebyId($id);
    $time = $data_article['date'];
    $date = date_create("$time");
    $date_formate = date_format($date, 'j F Y');
    /* --------- affichage commentaire par id  ------- */

    $commentaire = $visiteurController->get_commentaire($id);
}

if (isset($_POST['message'])) {
    if (Securite::estConnecte()) {
        $message = Securite::secureHTML($_POST['message']);
        $utilisateurController->poster_com($_POST['id'], $_SESSION['profil']['id'], $message);
    } else {
        Toolbox::ajouterMessageAlerte("Connectez-vous pour poster.", Toolbox::COULEUR_ROUGE);
    }
}







?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Zephyr Blog l'aventure">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/css/article.css">
    <link rel="stylesheet" href="./public/css/header.css">
    <title>Zephyr Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>




    <div class="general-main">


        <div class="container_diff">
            <?php require_once('./view/header_spe.php'); ?>
            <main class="c_main">


                <div class="layout_article">
                    <div class="categorie">
                        <p class="cat_date"><?= $date_formate ?> dans <span>Catégorie : <?= $data_article['nom'] ?> </span> </p>
                    </div>



                    <div class="titre">
                        <p><?= $data_article['titre'] ?></p>
                    </div>
                    <div class="article">
                        <p><?= $data_article['article'] ?></p>
                    </div>
                    <div class="com">

                        <form method="POST" action="./article.php?id=<?= $data_article['id'] ?>">
                            <input type="hidden" name="id" value="<?= $data_article['id'] ?>" />
                            <textarea class="champ_com" name=' message' placeholder="Poster votre commentaire" require></textarea>
                            <button class="btnValidCom" type="submit">Envoyer</button>

                        </form>
                        <?php require_once('./view/gestion_erreur.php'); ?>
                    </div>
                </div>

                <div class="container_commentaire">
                    <?php
                    foreach ($commentaire as $com) {
                        $time = $com['date'];
                        $date = date_create("$time");
                        $date_formate = date_format($date, 'd-m-Y');
                        $com['id'];



                        if (Securite::estConnecte() && $_SESSION['profil']["id"] == $com['id_utilisateur']) {
                    ?>
                            <div class="container_post_connecter">
                                <div class="info_utilisateur_post">
                                    <p><?php echo "<b>" . $com['login'] . "</b>" . ' vient de poster le :' . " $date_formate"; ?></p>
                                </div>
                                <div class="info_com">
                                    <p><?= $com['commentaire']; ?></p>

                                </div>

                            </div>


                        <?php } elseif (Securite::estConnecte()) { ?>
                            <div class="container_post">
                                <div class="info_utilisateur_post">
                                    <p><?php echo "<b>" . $com['login'] . "</b>" . ' vient de poster le :' . " $date_formate"; ?></p>
                                </div>
                                <div class="info_com">
                                    <p><?= $com['commentaire']; ?></p>

                                </div>

                            </div>




                        <?php } else { ?>

                            <div class="container_post">
                                <div class="info_utilisateur_post">
                                    <p><?php echo "<b>" . $com['login'] . "</b>" . ' vient de poster le :' . " $date_formate"; ?></p>
                                </div>
                                <div class="info_com">
                                    <p><?= $com['commentaire']; ?></p>


                                </div>



                            </div>

                    <?php }
                    } ?>
                </div>







            </main>
            <?php require_once('./view/footer.php'); ?>


        </div>
    </div>
</body>

</html>