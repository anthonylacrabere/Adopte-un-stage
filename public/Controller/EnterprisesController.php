<?php


namespace Controller;


use Kernel\AbstractController;
use Model\AdminModel;
use Model\SkillModel;
use Model\EnterprisesModel;
use Model\ActivityAreaModel;
use Model\MatchesModel;
use Kernel\Kernel;
use PDO;

class EnterprisesController extends AbstractController
{
    public function __construct() {
        parent::__construct();
    }

    public function welcome() {
        $this->template->addVariable("keywords", "Adopteunstage, vérification, email, connexion, inscription, entreprise");
        $this->template->addVariable("description", "Vérifiez votre email afin de vous connecter sur Adopteunstage.");
        $this->template->addVariable("title", "Adopteunstage - Vérification de votre email");

        Kernel::getInstance()->redirectIfConnected();
        
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises SET verified = ? WHERE vkey = ?");
        $stmt->execute([1, $_GET["vkey"]]);

        $this->template->renderView('enterprises/welcome');
    }

    public function search() {
        $this->template->addVariable("keywords", "Adopteunstage, recherches, préférences, filtrer, filtre");
        $this->template->addVariable("description", "Filtrez vos recherches afin d'avoir un résultat plus précis sur Adopteunstage");
        $this->template->addVariable("title", "Adopteunstage - Préférences de recherches");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("enterprise", "search");

        $this->template->addVariable("activitiesArea", ActivityAreaModel::getInstance()->getActivityArea());

        $this->template->renderView('enterprises/profile_search_preference');
    }

    public function home() {
        $this->template->addVariable("keywords", "Adopteunstage, swipe, swiper, like, dislike, entreprise, stagiaire, aime, aimer, rejeter, accueil, stage, poste");
        $this->template->addVariable("description", "Swiper pour trouver un stagiaire qui vous correspond");
        $this->template->addVariable("title", "Adopteunstage - Trouver un stagiaire ");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("enterprise", "home");
        Kernel::getInstance()->redirectIfProfilNotCompleted();

        $this->template->renderView('enterprises/home');
    }

    public function profil() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, menu, moi, informations, infos, données");
        $this->template->addVariable("description", "Vous pouvez naviguer sur les différentes pages de votre compte");
        $this->template->addVariable("title", "Adopteunstage - Mon compte");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("enterprise", "profil");

        $this->template->renderView('enterprises/profile');
    }

    public function matches() {
        $this->template->addVariable("keywords", "Adopteunstage, matchs, vos, match, matches, matche, like, dislike, aimer, rejeter, communiquer, message, entreprise, stagiaire, matching, relation");
        $this->template->addVariable("description", "Voici une liste des personnes avec qui vous avez, ou voulez matcher. Si une enveloppe apparaît, vous pouvez communiquer avec le stagiaire.");
        $this->template->addVariable("title", "Adopteunstage - Mes matchs");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("enterprise", "matches");

        $this->template->addVariable("matches", MatchesModel::getInstance()->getEnterpriseMatchesByID($_SESSION["user_id"]));
        $this->template->renderView('enterprises/matches');
    }

    public function contact() {
        $this->template->addVariable("keywords", "Adopteunstage, stagiaire, entreprise, communiquer, message, messagerie, contact, relation, matching, match");
        $this->template->addVariable("description", "Communiquez directement avec le stagiaire grâce à une messagerie et organisez votre rencontre physique.");
        $this->template->addVariable("title", "Adopteunstage - Contact");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("enterprise", "contact");

        $this->template->renderView("enterprises/contact");
    }

    public function profil_view() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, aperçu, entreprise, moi, carte, visite, infos, informations, donnée, données");
        $this->template->addVariable("description", "Aperçu de votre profil sous forme de carte de visite, vous pouvez modifier vos informations en cliquant sur l'icône.");
        $this->template->addVariable("title", "Adopteunstage - Aperçu du profil");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("enterprise", "profil_view");
        Kernel::getInstance()->redirectIfProfilNotCompleted();

        $this->template->addVariable("enterprise", EnterprisesModel::getInstance()->getEnterpriseInfoById($_SESSION["user_id"]));
        $this->template->addVariable("enterpriseActivity", ActivityAreaModel::getInstance()->getEnterpriseActivityArea($_SESSION["user_id"]));
        $this->template->addVariable("enterpriseAddresse", EnterprisesModel::getInstance()->getEnterpriseAddresse($_SESSION["user_id"]));

        $this->template->renderView('enterprises/profile_view');
    }

    public function profil_edit() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, entreprise, moi, modifier, infos, edit, editer, informations, donnée, données");
        $this->template->addVariable("description", "Vous pouvez modifier ou completer votre profil sur cette page.");
        $this->template->addVariable("title", "Adopteunstage - Modification du profil");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("enterprise", "profil_edit");

        $enterprise_id = $_SESSION["user_id"];

        if(isset($_POST["submit"])) {

            $enterprise_name = Kernel::getInstance()->clean($_POST["enterprise_name"]);
            $phone = Kernel::getInstance()->clean($_POST["phone"]);
            $activity = Kernel::getInstance()->clean($_POST['activity']);
            $addresse = Kernel::getInstance()->clean($_POST['addresse']);
            $bio = Kernel::getInstance()->clean($_POST["enterprise_bio"]);
            $job_title = Kernel::getInstance()->clean($_POST["enterprise_job_title"]);

            if(empty($enterprise_name)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner le nom de votre entreprise !');
            } elseif (empty($phone)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre numéro de téléphone !');
            } elseif(empty($activity)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre secteur d\'activité !');
            } elseif(empty($addresse)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre adresse !');
            } elseif(empty($job_title)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner l\'intitulé du poste !');
            } elseif (empty($bio)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez remplir vos informations !');
            } else {
                EnterprisesModel::getInstance()->updateEnterpriseName($enterprise_id, $enterprise_name);
                EnterprisesModel::getInstance()->updateEnterprisePhone($enterprise_id, $phone);
                EnterprisesModel::getInstance()->updateEnterpriseBio($enterprise_id, $bio);
                EnterprisesModel::getInstance()->updateEnterpriseJobTitle($enterprise_id, $job_title);

                if(!empty($activity)) {
                    if(ActivityAreaModel::getInstance()->getEnterpriseActivityArea($enterprise_id)) {
                        ActivityAreaModel::getInstance()->updateEnterpriseActivityArea($enterprise_id, $activity);
                    } else {
                        ActivityAreaModel::getInstance()->addEnterpriseActivityArea($enterprise_id, $activity);
                    }
                }

                if(!empty($addresse)) {
                    if(EnterprisesModel::getInstance()->getEnterpriseAddresse($enterprise_id)) {
                        EnterprisesModel::getInstance()->updateEnterpriseAddresse($enterprise_id, $addresse);
                    } else {
                    EnterprisesModel::getInstance()->addEnterpriseAddresse($enterprise_id, $addresse);
                    }
                }

                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    EnterprisesModel::getInstance()->addEnterpriseAvatar($enterprise_id);
                }

                Kernel::getInstance()->addAlert('success', 'Informations mise à jours avec succès');
                header('Refresh: 2;url= profil_view');
            }

        }

        $this->template->addVariable("enterprise", EnterprisesModel::getInstance()->getEnterpriseById($_SESSION["user_id"]));
        $this->template->addVariable("enterpriseActivity", ActivityAreaModel::getInstance()->getEnterpriseActivityArea($_SESSION["user_id"]));
        $this->template->addVariable("enterpriseAddresse", EnterprisesModel::getInstance()->getEnterpriseAddresse($_SESSION["user_id"]));

        $this->template->addVariable("activitiesArea", ActivityAreaModel::getInstance()->getActivityArea());

        $this->template->renderView('enterprises/profile_edit');
    }

    public function getEnterprises() {
        $data = EnterprisesModel::getInstance()->getEnterprises();
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data);
    }

    public function getEnterpriseActivity() {
        $data = ActivityAreaModel::getInstance()->getEnterpriseActivityArea($_GET["id"]);
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data);
    }

    public function getEnterpriseAddresse() {
        $data = EnterprisesModel::getInstance()->getEnterpriseAddresse($_GET["id"]);
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data);
    }

    public function createEnterprise() {
        EnterprisesModel::getInstance()->createEnterprise($_POST["enterprise_name"], $_POST["email"], $_POST["password"], 1);
        $lastID = SkillModel::getInstance()->lastID();
        echo '{
            "enterprise_name":"' . "{$_POST["enterprise_name"]}" .'",
            "id":"' . "{$lastID}" .'"
        }';
    }

    public function deleteEnterprise() {
        return EnterprisesModel::getInstance()->deleteEnterprise($_GET["id"]);
    }

    public function likeIntern() {
        EnterprisesModel::getInstance()->likeIntern($_GET["enterprise_id"], $_GET["intern_id"]);
    }
}