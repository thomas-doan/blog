<?php


require_once(__DIR__ . "/../MainManager.model.php");

class VisiteurManager extends MainManager
{

    /*    public function getCommentaire()
    {
        $req = $this->getBdd()->prepare("SELECT commentaires.id,login,commentaire,date, id_utilisateur from utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY date DESC");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas;
    } */


    public function get_commentaire_id($id)
    {


        $req = "SELECT commentaires.id, commentaires.commentaire, commentaires.id_article, commentaires.id_utilisateur, commentaires.date, utilisateurs.login 
        FROM commentaires 
        INNER JOIN articles ON articles.id = commentaires.id_article 
         INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur
        WHERE articles.id = :article_id ORDER BY date DESC;";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":article_id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultat_article = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat_article;
    }




    /*     public function getLikes()
    {
        $req = $this->getBdd()->prepare("SELECT fk_id_commentaires, COUNT(fk_id_commentaires) as nbr_likes from Intermediaire_like  WHERE fk_id_commentaires IN (
SELECT id FROM commentaires) GROUP BY fk_id_commentaires");
        $req->execute();
        $datas_likes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas_likes;
    } */


    /*     public function check_like()
    {

        $req = $this->getBdd()->prepare("SELECT * FROM Intermediaire_like");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();


        return $datas;
    }

    public function check_like2($fk_id_com, $fk_id_user)
    {

        $req = "SELECT * FROM Intermediaire_like WHERE (fk_id_commentaires =: fk_id_commentaires) AND ()fk_id_utilisateurs =: fk_id_utilisateurs";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":fk_id_commentaires", $fk_id_com, PDO::PARAM_STR);
        $stmt->bindValue(":fk_id_utilisateurs", $fk_id_user, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return count($resultat);
    } */

    public function get3articles()
    {
        $req = $this->getBdd()->prepare("SELECT articles.id, articles.titre, articles.description, articles.id_utilisateur, articles.id_categorie, categories.image FROM articles INNER JOIN categories ON articles.id_categorie = categories.id ORDER BY date DESC LIMIT 0,3;");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas;
    }


    public function get_article($id)
    {
        $req = "SELECT articles.id, articles.titre, articles.date, articles.image AS article_image, articles.description, articles.id_utilisateur, articles.article, articles.id_categorie, categories.image, categories.nom FROM articles INNER JOIN categories ON articles.id_categorie = categories.id WHERE (articles.id =:article_id)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":article_id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultat_article = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat_article;
    }

    public function getArticles($premier, $parPage)
    {
        $req = $this->getBdd()->prepare("SELECT articles.id, articles.titre, articles.date, articles.description, articles.id_utilisateur, articles.article, articles.id_categorie, categories.image, categories.nom FROM articles INNER JOIN categories ON articles.id_categorie = categories.id 
        ORDER BY date DESC LIMIT :premier, :parpage");
        /* $stmt = $this->getBdd()->prepare($req); */
        $req->bindValue(":premier", $premier, PDO::PARAM_INT);
        $req->bindValue(":parpage", $parPage, PDO::PARAM_INT);
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();


        return $datas;
    }

    public function getNbrArticles()
    {
        $req = $this->getBdd()->prepare(" SELECT COUNT(*) AS nb_articles FROM articles");

        $req->execute();
        $datas = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function get_cats()
    {

        $req = $this->getBdd()->prepare("SELECT categories.nom , categories.id FROM articles INNER JOIN categories ON articles.id_categorie = categories.id GROUP by categories.nom");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas;;
    }

    public function get_specific_cat($cat_spe, $premier1, $parPage1)
    {

        $req = $this->getBdd()->prepare("SELECT articles.id, articles.titre, articles.date, articles.description, articles.id_utilisateur, articles.article, articles.id_categorie, categories.image, categories.nom FROM articles INNER JOIN categories ON categories.id = articles.id_categorie WHERE categories.nom = :nom_categorie ORDER BY date DESC LIMIT :premier, :parpage");
        $req->bindValue(":nom_categorie", $cat_spe, PDO::PARAM_STR);
        $req->bindValue(":premier", $premier1, PDO::PARAM_INT);
        $req->bindValue(":parpage", $parPage1, PDO::PARAM_INT);
        $req->execute();
        $datas_cat = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas_cat;
    }

    public function nb_filtre_cat($nom_categorie)
    {
        $req = $this->getBdd()->prepare("SELECT COUNT(articles.id_categorie) as nb_articles FROM articles 
        INNER JOIN categories ON categories.id = articles.id_categorie 
        WHERE categories.nom = :nom_categorie");

        $req->bindValue(":nom_categorie", $nom_categorie, PDO::PARAM_STR);
        $req->execute();
        $resultat_article =  $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $resultat_article;
    }
}
