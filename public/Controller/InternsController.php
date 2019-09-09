<?php
namespace Controller;

use Kernel\AbstractController;
use Kernel\Kernel;
use Model\AdminModel;
use Model\QualificationsLevelModel;
use Model\MatchesModel;
use Model\SkillModel;
use Model\ActivityAreaModel;
use Model\InternsModel;

class InternsController extends AbstractController
{
    public function __construct() {
        parent::__construct();
    }

    public function welcome() {
        $this->template->addVariable("keywords", "Adopteunstage, vérification, email, connexion, inscription, stagiaire");
        $this->template->addVariable("description", "Vérifiez votre email afin de vous connecter sur Adopteunstage.");
        $this->template->addVariable("title", "Adopteunstage - Vérification de votre email");

        Kernel::getInstance()->redirectIfConnected();
        
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET verified = ? WHERE vkey = ?");
        $stmt->execute([1, $_GET["vkey"]]);

        $this->template->renderView('interns/welcome');
    }

    public function search() {
        $this->template->addVariable("keywords", "Adopteunstage, recherches, préférences, filtrer, filtre");
        $this->template->addVariable("description", "Filtrez vos recherches afin d'avoir un résultat plus précis sur Adopteunstage");
        $this->template->addVariable("title", "Adopteunstage - Préférences de recherches");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("intern", "search");
        

        $this->template->addVariable("ActivityArea", ActivityAreaModel::getInstance()->getActivityArea());

        $this->template->renderView('interns/profile_search_preference');
    }

    public function home() {
        $this->template->addVariable("keywords", "Adopteunstage, swipe, swiper, like, dislike, entreprise, stagiaire, aime, aimer, rejeter, accueil, stage, poste");
        $this->template->addVariable("description", "Swiper pour trouver un stage qui vous correspond");
        $this->template->addVariable("title", "Adopteunstage - Trouver un stage ");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("intern");
        Kernel::getInstance()->redirectIfProfilNotCompleted();

        $this->template->renderView('interns/home');
    }

    public function matches() {
        $this->template->addVariable("keywords", "Adopteunstage, matchs, vos, match, matches, matche, like, dislike, aimer, rejeter, communiquer, message, entreprise, stagiaire, matching, relation");
        $this->template->addVariable("description", "Voici une liste des personnes avec qui vous avez, ou voulez matcher. Si une enveloppe apparaît, vous pouvez communiquer avec l'entreprise.");
        $this->template->addVariable("title", "Adopteunstage - Mes matchs");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("intern", "matches");

        $this->template->addVariable("matches", MatchesModel::getInstance()->getInternMatchesByID($_SESSION["user_id"]));
        $this->template->renderView('interns/matches');
        
    }

    public function contact() {
        $this->template->addVariable("keywords", "Adopteunstage, stagiaire, entreprise, communiquer, message, messagerie, contact, relation, matching, match");
        $this->template->addVariable("description", "Communiquez directement avec l'entreprise grâce à une messagerie et organisez votre rencontre physique.");
        $this->template->addVariable("title", "Adopteunstage - Contact");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("intern", "contact");

        $this->template->renderView("interns/contact");
    }

    public function profil() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, menu, moi, informations, infos, données, stagiaire");
        $this->template->addVariable("description", "Vous pouvez naviguer sur les différentes pages de votre compte");
        $this->template->addVariable("title", "Adopteunstage - Mon compte");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("intern", "profil");

        $this->template->renderView('interns/profile');
    }

    public function profil_view() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, aperçu, stagiaire, moi, carte, visite, infos, informations, donnée, données");
        $this->template->addVariable("description", "Aperçu de votre profil sous forme de carte de visite, vous pouvez modifier vos informations en cliquant sur l'icône.");
        $this->template->addVariable("title", "Adopteunstage - Aperçu du profil");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("intern", "profil_view");
        Kernel::getInstance()->redirectIfProfilNotCompleted();

        $this->template->addVariable("intern", InternsModel::getInstance()->getInternById($_SESSION["user_id"]));
        $this->template->addVariable('internSkill', SkillModel::getInstance()->getInternSkill($_SESSION["user_id"]));
        $this->template->addVariable("internActivity", ActivityAreaModel::getInstance()->getInternActivityArea($_SESSION["user_id"]));
        $this->template->addVariable("internAddresse", InternsModel::getInstance()->getInternAddresse($_SESSION["user_id"]));

        $this->template->renderView('interns/profile_view');
    }

    public function profil_edit() {
        $this->template->addVariable("keywords", "Adopteunstage, profil, stagiaire, moi, modifier, infos, edit, editer, informations, donnée, données");
        $this->template->addVariable("description", "Vous pouvez modifier ou completer votre profil sur cette page.");
        $this->template->addVariable("title", "Adopteunstage - Modification du profil");

        Kernel::getInstance()->redirectIfDisconnected();
        Kernel::getInstance()->redirectByStatus("intern", "profil_edit");

        $intern_id = $_SESSION["user_id"];

        if(isset($_POST["submit"])) {

            $firstname = Kernel::getInstance()->clean($_POST["firstname"]);
            $lastname = Kernel::getInstance()->clean($_POST["lastname"]);
            $phone = Kernel::getInstance()->clean($_POST["phone"]);
            $age = Kernel::getInstance()->clean($_POST["age"]);
            $activity = Kernel::getInstance()->clean($_POST['activity']);
            $qualificationLevel = Kernel::getInstance()->clean($_POST["qualificationLevel"]);
            $skill = Kernel::getInstance()->clean($_POST["skill"]);
            $addresse = Kernel::getInstance()->clean($_POST['addresse']);
            $speech = Kernel::getInstance()->clean($_POST["user_speech"]);

            if(empty($firstname)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner un nom !');
            } elseif(empty($lastname)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner un prénom !');
            } elseif (empty($phone)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre numéro de téléphone !');
            } elseif (empty($age)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre âge !');
            } elseif ($age < 10 & $age > 99) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner un âge valide (entre 10 et 99 ans) !');
            } elseif(empty($activity)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre secteur d\'activité !');
            } elseif(empty($qualificationLevel)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre niveau d\'étude !');
            } elseif(empty($skill)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre compétence principal !');
            } elseif(empty($addresse)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez renseigner votre adresse !');
            } elseif (empty($speech)) {
                Kernel::getInstance()->addAlert('danger', 'Veillez ajouter vos informations !');
            } else {
                InternsModel::getInstance()->updateInternFirstName($intern_id, $firstname);
                InternsModel::getInstance()->updateInternLastName($intern_id, $lastname);
                InternsModel::getInstance()->updateInternPhone($intern_id, $phone);
                InternsModel::getInstance()->updateInternAge($intern_id, $age);
                InternsModel::getInstance()->setInternSpeech($intern_id, $speech);

                if(!empty($qualificationLevel)) {
                    if(QualificationsLevelModel::getInstance()->getInternQualificationsLevel($intern_id)) {
                        QualificationsLevelModel::getInstance()->updateInternQualificationsLevel($intern_id, $qualificationLevel);
                    } else {
                        QualificationsLevelModel::getInstance()->addInternQualificationsLevel($intern_id, $qualificationLevel);
                    }
                }

                if(!empty($skill)) {
                    SkillModel::getInstance()->addInternSkill($intern_id, $skill);
                }

                if(!empty($activity)) {
                    ActivityAreaModel::getInstance()->addInternActivityArea($intern_id, $activity);
                }

                if(!empty($addresse)) {
                    InternsModel::getInstance()->addInternAddresse($intern_id, $addresse);
                }

                if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                    InternsModel::getInstance()->addInternAvatar($intern_id);
                }

                Kernel::getInstance()->addAlert('success', 'Informations mise à jours avec succès');
                //UserModel::getInstance()->setUserAvatar($_SESSION["intern_id"], $avatarName);
                header('Refresh: 2;url= profil_view');
            }

        }

        $this->template->addVariable("intern", InternsModel::getInstance()->getInternById($_SESSION["user_id"]));
        $this->template->addVariable('internSkill', SkillModel::getInstance()->getInternSkill($_SESSION["user_id"]));
        $this->template->addVariable("internActivity", ActivityAreaModel::getInstance()->getInternActivityArea($_SESSION["user_id"]));
        $this->template->addVariable("internAddresse", InternsModel::getInstance()->getInternAddresse($_SESSION["user_id"]));
        $this->template->addVariable("internQualificationsLevel", QualificationsLevelModel::getInstance()->getInternQualificationsLevel($_SESSION["user_id"]));

        $this->template->addVariable("activitiesArea", ActivityAreaModel::getInstance()->getActivityArea());
        $this->template->addVariable("skills", SkillModel::getInstance()->getSkills());
        $this->template->addVariable('qualificationsLevel', QualificationsLevelModel::getInstance()->getQualificationsLevel());

        $this->template->renderView("interns/profile_edit");
    }

    public function getInterns() {
        $data = InternsModel::getInstance()->getInterns();
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data);
    }

    public function createIntern() {
        InternsModel::getInstance()->addIntern($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["password"], $_POST["gender"], $_POST["age"], $_POST["phone"], $_POST["verified"]);
        $lastID = SkillModel::getInstance()->lastID();
        echo '{
            "firstname":"' . "{$_POST["firstname"]}" .'",
            "lastname":"' . "{$_POST["lastname"]}" .'",
            "id":"' . "{$lastID}" .'"
        }';
    }

    public function deleteIntern() {
        return InternsModel::getInstance()->deleteIntern($_GET["id"]);
    }

    public function likeEnterprise() {
        InternsModel::getInstance()->likeEnterprise($_GET["intern_id"], $_GET["enterprise_id"]);
    }
}