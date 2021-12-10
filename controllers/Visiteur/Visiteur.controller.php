<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Visiteur/Visiteur.model.php");
require_once("./controllers/Securite.class.php");

class VisiteurController extends MainController
{
    private $visiteurManager;

    public function __construct()
    {
        $this->visiteurManager = new VisiteurManager();
    }

    public function accueil()
    {

        $data_page = [
            "page_description" => "Nos bouquets Zen",
            "page_title" => "Flower power",
            "page_css" => ["main_home.css"],
            "view" => "views/Visiteur/accueil.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function recup_commentaires($id_article)
    {
        $datas = $this->visiteurManager->get_commentaire_id($id_article);
        /*         $datas_de_likes = $this->visiteurManager->getLikes();
        $check_likes = $this->visiteurManager->check_like(); */

        return $datas;
    }

    public function get_commentaire($id_article)
    {
        $datas = $this->visiteurManager->get_commentaire_id($id_article);
        /*         $datas_de_likes = $this->visiteurManager->getLikes();
        $check_likes = $this->visiteurManager->check_like(); */

        return $datas;
    }

    /*     public function get_like()
    {
        $datas_de_likes = "";
        $data_page1 = [
            "res_like" => $datas_de_likes,
            "page_css" => ["main_home.css", "livreOr.css"],
            "view" => "views/Visiteur/livreOr.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page1);
    } */


    public function login()
    {
        $data_page = [
            "page_description" => "Page de connexion Flower power",
            "page_title" => "Page de connexion flower power",
            "page_css" => ["login.css", "main_home.css"],
            "view" => "views/Visiteur/login.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function creerCompte()
    {
        $data_page = [
            "page_description" => "Page de création de compte",
            "page_title" => "Page de création de compte flower power",
            "page_css" => ["login.css", "main_home.css"],
            "view" => "views/Visiteur/creerCompte.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }


    public function troisArticlesRecents()
    {
        $troisArticles = $this->visiteurManager->get3Articles();
        return $troisArticles;
    }

    public function tousLesArticles($premier, $parPage)
    {
        $articles = $this->visiteurManager->getArticles($premier, $parPage);
        return $articles;
    }


    public function getArticlebyId($id)
    {
        $article_id = $this->visiteurManager->get_article($id);

        return $article_id;
    }


    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }


    public function nbArticles()
    {
        $nbrTotal = $this->visiteurManager->getNbrArticles();
        return $nbrTotal;
    }
}
