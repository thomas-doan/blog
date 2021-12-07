<?php
require_once("./models/MainManager.model.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");

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

    public function getCommentaire()
    {
        $req = $this->getBdd()->prepare("SELECT * FROM commentaires ORDER BY date DESC");
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



    public function bdModificationAdminLoginUser($login, $newLogin)
    {
        $req = "UPDATE utilisateurs set login = :newlogin WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":newlogin", $newLogin, PDO::PARAM_STR);
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
        $req = "UPDATE utilisateurs set role = :role WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
