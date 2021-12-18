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


$getcatadmin = $administrateurController->recup_cats();





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
        $file = "$msg_description" .  $uniqueName  . "." . $extension;

        $nom = './public/image/' . "$msg_description" . $uniqueName  . "." . $extension;
        define('SITE_ROOT', realpath(dirname(__FILE__)));
        move_uploaded_file($tmpName, SITE_ROOT . '/public/image/' . $file);

        $administrateurController->admin_creation_categorie($nom, $msg_description);
    }
}

if (!empty($_POST['idSupprCat'])) {
    $administrateurController->validation_modificationSupprAdminCat($_POST['idSupprCat']);
}


if (!empty($_POST['nom'])) {
    $nom_categorie = Securite::secureHTML($_POST['nom']);
    $administrateurController->validation_modificationNomAdminCat($_POST['id'], $nom_categorie);
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
    <title>Zephyr Blog administration categorie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

</head>

<body>




    <div class="general-main">


        <div class="container_diff">
            <?php require_once('./view/header_spe.php'); ?>
            <div class="text-center">

                <?php require_once('./view/gestion_erreur.php'); ?>
                <h1>Gestion des categories</h1>

                <div class="creation_categorie_admin">
                    <p>Créer une categorie : </p>
                    <div class="champ_cat_admin">
                        <form action="administration_categorie.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="add_nom_categorie" value="" placeholder="nom de votre categorie" />

                            <input type="file" name="file">

                            <button type="submit"> Valider

                            </button>

                        </form>
                    </div>

                </div>

                </button></a>

                <div>
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Categorie</th>
                                <th>Supprimer</th>

                            </tr>



                            <?php foreach ($getcatadmin as $afficher_cat) {
                                if ($afficher_cat['nom'] !== "categorie suppr") {
                            ?>
                                    <div class="text-center">
                                        <tr>


                                            <td><?= $afficher_cat['nom'] ?>

                                                <div>
                                                    <form method="POST" action="administration_categorie.php">
                                                        <div class="row d-flex justify-content-center">

                                                            <div class="col-6 col-sm-5">
                                                                <input type="hidden" name="id" value="<?= $afficher_cat['id'] ?>" />
                                                                <input type="text" class="form-control" name="nom" value="<?= $afficher_cat['nom'] ?>" required />

                                                                <button class="col-6 col-sm-4 btn btn-success" type="submit">
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

                                                <form method="POST" action="administration_categorie.php">
                                                    <input type="hidden" name="idSupprCat" value="<?= $afficher_cat['id'] ?>" />
                                                    <button id="btnSupCompte" class="btn btn-danger">X</button>
                                                </form>
                                            </td>
                                        </tr>



                                    </div>


                            <?php }
                            }
                            ?>
                        </thead>
                    </table>
                </div>
            </div>
        </div>



        <?php require_once('./view/footer.php'); ?>
    </div>
    <script>
        AOS.init({
            duration: 2000,
        })
    </script>
</body>

</html>