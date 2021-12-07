<?php
require_once("./models/MainManager.model.php");

class VisiteurManager extends MainManager
{

    public function getCommentaire()
    {
        $req = $this->getBdd()->prepare("SELECT commentaires.id,login,commentaire,date, id_utilisateur from utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ORDER BY date DESC");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas;
    }

    public function getLikes()
    {
        $req = $this->getBdd()->prepare("SELECT fk_id_commentaires, COUNT(fk_id_commentaires) as nbr_likes from Intermediaire_like  WHERE fk_id_commentaires IN (
SELECT id FROM commentaires) GROUP BY fk_id_commentaires");
        $req->execute();
        $datas_likes = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $datas_likes;
    }


    public function check_like()
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
    }
}
