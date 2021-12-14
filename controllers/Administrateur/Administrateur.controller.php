<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Administrateur/Administrateur.model.php");



class AdministrateurController extends MainController
{
    private $administrateurManager;

    public function __construct()
    {
        $this->administrateurManager = new AdministrateurManager();
    }




    public function droits()
    {
        $utilisateurs = $this->administrateurManager->getUtilisateurs();

        return $utilisateurs;
    }

    public function coms()
    {
        $allComs = $this->administrateurManager->getCommentaires();
        return $allComs;
    }

    public function liste_articles()
    {
        $data = $this->administrateurManager->get_all_articles();
        return $data;
    }

    public function admin_creer_com($id, $message, $article)
    {


        if (!empty($message)) {
            if ($this->administrateurManager->creation_com($id, $message, $article)) {
                Toolbox::ajouterMessageAlerte("le message est posté", Toolbox::COULEUR_VERTE);
            }
        } else {
            Toolbox::ajouterMessageAlerte("Le message est vide", Toolbox::COULEUR_ROUGE);
            header("Refresh:0; ./admin_creer_com.php");
            exit();
        }

        header("Location: ./administration_com.php");
        exit();
    }


    public function validation_modificationAdminLogin($id, $login)
    {


        if ($this->administrateurManager->verifLoginDisponible($login)) {
            if ($this->administrateurManager->bdModificationAdminLoginUser($id, $login)) {

                Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
            } else {
                Toolbox::ajouterMessageAlerte("test", Toolbox::COULEUR_ROUGE);
            }
        } else {
            Toolbox::ajouterMessageAlerte("login déjà utilisé ou vide", Toolbox::COULEUR_ROUGE);
        }


        header("Location: administration_user.php");
        exit();
    }

    public function validation_modificationAdminCom($comId, $modifCom)
    {

        if ($this->administrateurManager->bdModificationAdminCom($comId, $modifCom)) {

            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Refresh:0; ../blog/administration_com.php");
        exit();
    }

    public function validation_modificationSupprAdminCom($SupprComId)
    {

        if ($this->administrateurManager->bdModificationAdminSupprCom($SupprComId)) {

            Toolbox::ajouterMessageAlerte("La suppression est effectuée", Toolbox::COULEUR_VERTE);
        }
        header("Refresh:0; ../blog/administration_com.php");
        exit();
    }


    public function validation_modificationAdminPrenom($login, $prenom)
    {

        if ($this->administrateurManager->bdModificationAdminPrenomUser($login, $prenom)) {

            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: administration_user.php");
        exit();
    }

    public function validation_modificationAdminNom($login, $nom)
    {

        if ($this->administrateurManager->bdModificationAdminNomUser($login, $nom)) {

            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: administration_user.php");
        exit();
    }

    public function validation_modificationAdminMail($login, $mail)
    {

        if ($this->administrateurManager->bdModificationAdminMailUser($login, $mail)) {

            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: administration_user.php");
        exit();
    }


    public function validation_modificationRole($login, $role)
    {
        if ($this->administrateurManager->bdModificationRoleUser($login, $role)) {
            Toolbox::ajouterMessageAlerte("La modification a été prise en compte", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("La modification n'a pas été prise en compte", Toolbox::COULEUR_ROUGE);
        }
        header("Location: administration_user.php");
        exit();
    }

    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}
