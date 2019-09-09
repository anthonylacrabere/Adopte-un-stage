<?php
namespace Controller;

use Kernel\Kernel;
use Kernel\AbstractController;
use Model\InternsModel;
use Model\AdminModel;

class IndexController extends AbstractController
{
    public function __construct() {
        parent::__construct();
    }

    public function home() {
        $this->template->addVariable("keywords", "Adopteunstage, accueil, matching, mise, en, relation, stagiaire, entreprise, tinder, match, like, dislike, aimer, rejeter");
        $this->template->addVariable("description", "Bienvenue sur Adopteunstage, vous pouvez vous connecter ou vous inscrire si ce n'est pas déjà fait.");
        $this->template->addVariable("title", "Adopteunstage - Accueil");

        Kernel::getInstance()->redirectIfConnected(); 

        $this->template->renderView('home', 'base_index');
    }

    public function pageNotFound() {
        header('HTTP/1.0 404 Not Found');

        $this->template->renderView('404');
    }

}