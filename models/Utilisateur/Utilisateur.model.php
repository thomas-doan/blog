<?php
require_once("./models/MainManager.model.php");

class UtilisateurManager extends MainManager
{

    private function getPasswordUser($login)
    {
        $req = "SELECT password FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        if (!empty($resultat['password'])) {
            return $resultat['password'];
        }
        return null;
    }

    public function isCombinaisonValide($login, $password)
    {
        $passwordBD = $this->getPasswordUser($login);
        return password_verify($password, $passwordBD);
    }

    public function estCompteActive($login)
    {
        $req = "SELECT est_valide FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ((int)$resultat['est_valide'] === 1) ? true : false;
    }

    public function getUserInformation($login)
    {
        $req = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }

    public function bdCreerCompte($login, $prenom, $nom, $passwordCrypte, $mail, $clef, $image, $role)
    {
        $req = "INSERT INTO utilisateurs (login, prenom, nom, password, mail, est_valide, id_droits, clef, image)
        VALUES (:login, :prenom, :nom, :password, :mail, 0, 1, :clef, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordCrypte, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function verifLoginDisponible($login)
    {
        $utilisateur = $this->getUserInformation($login);
        return empty($utilisateur);
    }

    public function bdValidationMailCompte($login, $clef)
    {
        $req = "UPDATE utilisateurs set est_valide = 1 WHERE login = :login and clef = :clef";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationMailUser($login, $mail)
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

    //MODIF PRENOM modification
    public function bdModificationPrenomUser($login, $prenom)
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
    //login modification
    public function bdModificationLoginUser($login, $new_login)
    {
        $req = "UPDATE utilisateurs set login = :newlogin WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":newlogin", $new_login, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }



    public function bdModificationNomUser($login, $nom)
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


    public function bdModificationPassword($login, $password)
    {
        $req = "UPDATE utilisateurs set password = :password WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdSuppressionCompte($login)
    {
        $req = "DELETE FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    /*   public function bdAjoutImage($login, $image)
    {
        $req = "UPDATE utilisateurs set image = :image WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    } */

    public function getImageUtilisateur($login)
    {
        $req = "SELECT image FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['image'];
    }

    public function ajouter_commentaire($id_article, $id, $message)
    {
        $req = "INSERT INTO commentaires ( commentaire, id_article, id_utilisateur, date) VALUES (:commentaire, :id_article, :id_utilisateur, CURRENT_TIMESTAMP)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id_article", $id_article, PDO::PARAM_STR);
        $stmt->bindValue(":id_utilisateur", $id, PDO::PARAM_STR);
        $stmt->bindValue(":commentaire", $message, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function ajouter_like($id_com, $id_user)
    {

        $req = "INSERT INTO Intermediaire_like (fk_id_commentaires, fk_id_utilisateurs, etat_like) VALUES (:fk_id_commentaires, :fk_id_utilisateurs, 2)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":fk_id_commentaires", $id_user, PDO::PARAM_STR);
        $stmt->bindValue(":fk_id_utilisateurs", $id_com, PDO::PARAM_STR);
        $stmt->execute();
        $comDisponible = $stmt;
        $stmt->closeCursor();
        return $comDisponible;
    }

    public function suppr_like($id_com, $id_user)
    {

        $req = "DELETE FROM Intermediaire_like WHERE fk_id_commentaires = :fk_id_commentaires AND fk_id_utilisateurs = :fk_id_utilisateurs";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":fk_id_commentaires", $id_user, PDO::PARAM_STR);
        $stmt->bindValue(":fk_id_utilisateurs", $id_com, PDO::PARAM_STR);
        $stmt->execute();
        $comSuppr = $stmt;
        $stmt->closeCursor();
        return $comSuppr;
    }


    public function check_like($fk_id_com, $fk_id_user)
    {

        $req = "SELECT * FROM Intermediaire_like WHERE fk_id_commentaires = :fk_id_commentaires AND fk_id_utilisateurs = :fk_id_utilisateurs";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":fk_id_commentaires", $fk_id_com, PDO::PARAM_STR);
        $stmt->bindValue(":fk_id_utilisateurs", $fk_id_user, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
}
