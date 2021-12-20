<?php
require_once(__DIR__ . "/../MainManager.model.php");
require_once(__DIR__ . "/../../controllers/Utilisateur/Utilisateur.controller.php");

class AdministrateurManager extends MainManager
{
    public function getUtilisateurs()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM utilisateurs");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();


        return $datas;
    }

    public function getCategories()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM categories");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();


        return $datas;
    }

    public function creation_com($id, $message, $article)
    {

        $req = "INSERT INTO commentaires (commentaire, id_article, id_utilisateur, date)
        VALUES (:commentaire, :id_article,:id, CURRENT_TIMESTAMP)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":commentaire", $message, PDO::PARAM_STR);
        $stmt->bindValue(":id_article", $article, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function creation_article($id, $id_utilisateur, $image, $message, $titre, $description)
    {

        $req = "INSERT INTO articles (titre, description, article, image, id_utilisateur, id_categorie, date)
        VALUES (:titre, :description, :article, :image, :id_utilisateur, :id_categorie, CURRENT_TIMESTAMP)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":article", $message, PDO::PARAM_STR);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":id_utilisateur", $id_utilisateur, PDO::PARAM_STR);
        $stmt->bindValue(":id_categorie", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }


    public function bdCreationCategorie($file, $description)
    {
        $req = "INSERT INTO categories (nom, image)
        VALUES (:nom, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":image", $file, PDO::PARAM_STR);
        $stmt->bindValue(":nom", $description, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }


    public function get_all_articles()
    {
        $req = $this->getBdd()->prepare("SELECT articles.id, articles.titre, articles.date, articles.description, articles.id_utilisateur , utilisateurs.login  , articles.article, articles.id_categorie, categories.image, categories.nom

FROM articles INNER JOIN categories ON articles.id_categorie = categories.id
 INNER JOIN utilisateurs ON utilisateurs.id = articles.id_utilisateur 


ORDER BY date DESC; ");
        /* $stmt = $this->getBdd()->prepare($req); */
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas;
    }


    public function getCommentaires()
    {
        $req = $this->getBdd()->prepare("SELECT commentaires.id,login,commentaire,date, id_utilisateur from utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY date DESC");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas;
    }

    public function getUserAdminInformation($login)
    {
        $req = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function verifLoginDisponible($login)
    {
        $utilisateur = $this->getUserAdminInformation($login);
        return empty($utilisateur);
    }

    public function bdModificationAdminCom($comId, $modifCom)
    {
        $req = "UPDATE commentaires set commentaire = :commentaire WHERE id = :id ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $comId, PDO::PARAM_STR);
        $stmt->bindValue(":commentaire", $modifCom, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = $stmt;
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationAdminSupprCom($SupprComId)
    {
        $req = "DELETE FROM commentaires WHERE id = :id ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $SupprComId, PDO::PARAM_STR);
        $stmt->execute();
        $comSuppr = $stmt;
        $stmt->closeCursor();
        return $comSuppr;
    }

    public function bdModificationAdminSupprArticle($SupprArtId)
    {
        $req = "DELETE FROM articles WHERE id = :id ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $SupprArtId, PDO::PARAM_STR);
        $stmt->execute();
        $comSuppr = $stmt;
        $stmt->closeCursor();
        return $comSuppr;
    }



    public function bdModificationAdminSupprCategorie($idSupprCat)
    {
        $req = "UPDATE  categories SET nom = 'categorie suppr' WHERE id = :id ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $idSupprCat, PDO::PARAM_STR);
        $stmt->execute();
        $comSuppr = $stmt;
        $stmt->closeCursor();
        return $comSuppr;
    }

    public function bdModificationAdminLoginUser($id, $login)
    {
        $req = "UPDATE utilisateurs set login = :login WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }



    public function bdModificationAdminPrenomUser($login, $prenom)
    {
        $req = "UPDATE utilisateurs set prenom = :prenom WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }



    public function bdModificationAdminNomUser($login, $nom)
    {
        $req = "UPDATE utilisateurs set nom = :nom WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationAdminMailUser($login, $mail)
    {
        $req = "UPDATE utilisateurs set mail = :mail WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }


    public function bdModificationRoleUser($login, $role)
    {
        $req = "UPDATE utilisateurs set id_droits = :role WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationAdminArticleTitre($id, $titre)
    {
        $req = "UPDATE articles set titre = :titre WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationAdminArticleContenu($id, $message)
    {
        $req = "UPDATE articles set article = :article WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":article", $message, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }




    public function bdModificationAdminCat($id, $message)
    {
        $req = "UPDATE categories set nom = :nom WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $message, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }


    public function bdModificationAdminArticleDescription($id, $description)
    {
        $req = "UPDATE articles set description = :description WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }



    public function bdModificationAdminArticleLogin($id, $login)
    {
        $req = "UPDATE articles set id_utilisateur = :login WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationAdminArticleCategorie($id, $categorie)
    {
        $req = "UPDATE articles set id_categorie = :categorie WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":categorie", $categorie, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
