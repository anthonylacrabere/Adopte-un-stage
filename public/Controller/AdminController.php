<?php


namespace Controller;

use Kernel\Kernel;
use Kernel\AbstractController;
use Model\AdminModel;
use Model\EnterprisesModel;
use Model\SkillModel;
use Model\InternsModel;
use PDO;

class AdminController extends AbstractController
{
    public function __construct() {
        parent::__construct();
    }

    public function dashboard() {
        $this->template->addVariable("keywords", "Adopteunstage, admin, administrateur, menu, panel, gestion, gérer");
        $this->template->addVariable("description", "Panneau de gestion de l'administration");
        $this->template->addVariable("title", "Adopteunstage - Panneau de gestion de l'administration");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectIfNotAdmin($_SESSION["user_id"]);

        $this->template->renderView("admin/dashboard");
    }

    public function interns() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, stagiaires, modifier, infos, edit, editer, informations, donnée, données, ajout, ajouter");
        $this->template->addVariable("description", "Aperçu sous forme d'une liste des stagiaires de Adopteunstage");
        $this->template->addVariable("title", "Adopteunstage - Aperçu des stagiaires");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectIfNotAdmin($_SESSION["user_id"]);

        if(isset($_GET["id"])) {
            $this->template->addVariable("intern", InternsModel::getInstance()->getInternById($_GET["id"]));
            $this->template->renderView("admin/intern");
        } else {
            $this->template->addVariable("interns", InternsModel::getInstance()->getInternsEvenIfNotCompleted());
            $this->template->renderView("admin/interns");
        }
    }

    public function entreprises() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, entreprise, moi, modifier, infos, edit, editer, informations, donnée, données");
        $this->template->addVariable("description", "Aperçu sous forme d'une liste des entreprises de Adopteunstage.");
        $this->template->addVariable("title", "Adopteunstage - Aperçu des entreprises");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectIfNotAdmin($_SESSION["user_id"]);

        if(isset($_GET["id"])) {
            $this->template->addVariable("enterprise", EnterprisesModel::getInstance()->getEnterpriseById($_GET["id"]));
            $this->template->renderView("admin/entreprise");
        } else {
            $this->template->addVariable("enterprisesInfos", EnterprisesModel::getInstance()->getEnterprisesEvenIfNotCompleted());
            $this->template->renderView("admin/entreprises");
        }
    }

    public function skills() {
        $this->template->addVariable("keywords", "Adopteunstage, entreprise, compétence, skill, modifier, infos, informations, donnée, données");
        $this->template->addVariable("description", "Vous pouvez supprimer ou ajouter une compétence.");
        $this->template->addVariable("title", "Adopteunstage - Aperçu des compétences");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectIfNotAdmin($_SESSION["user_id"]);
    
        $this->template->addVariable("skills", SkillModel::getInstance()->getSkills());

        $this->template->renderView("admin/skills");
    }
}