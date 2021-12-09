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
        $allComs = $this->administrateurManager->getCommentaire();

        $data_page = [
            "page_description" => "Gestion des coms",
            "page_title" => "Gestion des coms",
            "coms" => $allComs,
            "view" => "views/Administrateur/coms.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
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
        header("Location: administration_user.php");
        exit();
    }

    public function validation_modificationSupprAdminCom($SupprComId)
    {

        if ($this->administrateurManager->bdModificationAdminSupprCom($SupprComId)) {

            Toolbox::ajouterMessageAlerte("La suppression est effectuée", Toolbox::COULEUR_VERTE);
        }
        header("Location: administration_user.php");
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
