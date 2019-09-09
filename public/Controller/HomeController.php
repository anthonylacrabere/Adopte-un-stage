<?php
namespace Controller;

use Kernel\AbstractController;
use Model\InternsModel;
use Model\EnterprisesModel;
use Model\AdminModel;
use Kernel\Kernel;

class HomeController extends AbstractController
{
    public function __construct() {
        parent::__construct();
    }

    public function register() {
        $this->template->addVariable("keywords", "Adopteunstage, inscription, statuts, choix, stagiaire, entreprise");
        $this->template->addVariable("description", "Inscription sur Adopteunstage, choisissez stagiaire ou entreprise pour pouvoir vous inscrire.");
        $this->template->addVariable("title", "Adopteunstage - Inscription");
        Kernel::getInstance()->redirectIfConnected();

        $this->template->renderView('home/register', "base");
    }

    public function register_enterprise() {
        $this->template->addVariable("keywords", "Adopteunstage, inscription, entreprise");
        $this->template->addVariable("description", "Inscrivez-vous en tant qu'entreprise sur Adopteunstage.");
        $this->template->addVariable("title", "Adopteunstage - Inscription entreprise");

        Kernel::getInstance()->redirectIfConnected();

        if(isset($_POST['submit'])) {
            $enterprise_name = Kernel::getInstance()->clean($_POST["enterprise_name"]);
            $email = $_POST["email"];
            $password = $_POST["password"];
            $confirm_pwd = $_POST["password_confirm"];

            if(empty($enterprise_name)){
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer le nom de votre entreprise");
            } elseif (empty($email)) {
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer votre adresse email");
            } elseif (empty($password)) {
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer votre mot de passe");
            } elseif (empty($confirm_pwd)) {
                Kernel::getInstance()->addAlert("danger","Veuillez confirmer votre mot de passe");
            } else {
                if ($password !== $confirm_pwd) {
                    Kernel::getInstance()->addAlert("danger","Les deux mots de passe ne sont pas identiques.");
                } elseif (strlen($password) < 8) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit avoir au moins 8 caractère.");
                } elseif (!preg_match('@[A-Z]@', $password)) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit contenir au moins une majuscule.");
                } elseif (!preg_match('@[a-z]@', $password)) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit contenir au moins une minuscule.");
                } elseif (!preg_match('@[0-9]@', $password)) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit contenir au moins un chiffre.");
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Kernel::getInstance()->addAlert("danger","Votre adresse email est invalide.");
                } else {
                    $validmail = Kernel::getInstance()->getPdo()->prepare("SELECT email FROM enterprises WHERE email = ?");
                    $validmail->execute([$email]);
            
                    $validmailIntern = Kernel::getInstance()->getPdo()->prepare("SELECT email FROM interns WHERE email = ?");
                    $validmailIntern->execute([$email]);
                
                    if (!$validmail->fetch() && !$validmailIntern->fetch()) {
                        EnterprisesModel::getInstance()->newRegistration($enterprise_name, $email, $password);
                        Kernel::getInstance()->addAlert('success', 'Merci de vous être inscrit sur notre site, vous allez recevoir un mail afin de finaliser votre inscription !');
                    } else {
                        Kernel::getInstance()->addAlert('danger', 'Cette adresse email est déjà utilisée !');
                    }
                }
            }
        }

        $this->template->renderView('home/registerEnterprise');
    }

    public function register_intern() {
        $this->template->addVariable("keywords", "Adopteunstage, inscription, stagiaire");
        $this->template->addVariable("description", "Inscrivez-vous en tant que stagiaire sur Adopteunstage.");
        $this->template->addVariable("title", "Adopteunstage - Inscription stagiaire");

        Kernel::getInstance()->redirectIfConnected();

        if(isset($_POST['submit'])) {
            $firstname      =   Kernel::getInstance()->clean($_POST["firstname"]);
            $lastname       =   Kernel::getInstance()->clean($_POST["lastname"]);
            $gender         =   Kernel::getInstance()->clean($_POST["gender"]);
            $confirm_pwd    =   Kernel::getInstance()->clean($_POST["password_confirm"]);
            $email          =   $_POST["email"];
            $password       =   $_POST["password"];

            if(empty($firstname)){
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer votre nom");
            } elseif (empty($lastname)) {
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer votre prénom");
            } elseif (empty($email)) {
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer votre adresse email");
            } elseif (empty($gender)) {
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer votre sexe");
            } elseif (empty($password)) {
                Kernel::getInstance()->addAlert("danger","Veuillez indiquer votre mot de passe");
            } elseif (empty($confirm_pwd)) {
                Kernel::getInstance()->addAlert("danger","Veuillez confirmer votre mot de passe");
            } else {
                if ($password !== $confirm_pwd) {
                    Kernel::getInstance()->addAlert("danger","Les deux mots de passe ne sont pas identiques.");
                } elseif (strlen($password) < 8) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit avoir au moins 8 caractères.");
                } elseif (!preg_match('@[A-Z]@', $password)) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit contenir au moins une majuscule.");
                } elseif (!preg_match('@[a-z]@', $password)) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit contenir au moins une minuscule.");
                } elseif (!preg_match('@[0-9]@', $password)) {
                    Kernel::getInstance()->addAlert("danger","Votre mot de passe doit contenir au moins un chiffre.");
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    Kernel::getInstance()->addAlert("danger","Votre adresse email est invalide.");
                } else {
                    $validmail = Kernel::getInstance()->getPdo()->prepare("SELECT email FROM enterprises WHERE email = ?");
                    $validmail->execute([$email]);
            
                    $validmailIntern = Kernel::getInstance()->getPdo()->prepare("SELECT email FROM interns WHERE email = ?");
                    $validmailIntern->execute([$email]);
                    
                    if (!$validmail->fetch() && !$validmailIntern->fetch()) {
                        InternsModel::getInstance()->newRegistration($firstname, $lastname, $email, $password, $gender);
                        Kernel::getInstance()->addAlert('success', 
                        'Merci de vous être inscrit sur notre site, vous allez recevoir un mail afin de finaliser votre inscription !');
                    } else {
                        Kernel::getInstance()->addAlert('danger', 'Cette adresse email est déjà utilisée !');
                    }
                }
            }
        }

        $this->template->renderView('home/registerIntern');
    }

    public function login() {
        $this->template->addVariable("keywords", "Adopteunstage, connexion, accès, connecter, stagiaire, entreprise");
        $this->template->addVariable("description", "Connectez-vous sur Adopteunstage.");
        $this->template->addVariable("title", "Adopteunstage - Connexion");

        Kernel::getInstance()->redirectIfConnected();

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if (!empty($email) && !empty($password)) {
                $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM interns WHERE email = ?");
                $stmt->execute([$email]);

                if ($stmt->rowCount() == 1) {
                    if (InternsModel::getInstance()->connexion($email, $password)) {
                        Kernel::getInstance()->addAlert("success","Connexion avec succès. Redirection vers votre compte");
                        header("Refresh: 1;url= ../interns/home");
                    }
                } else {
                    if(EnterprisesModel::getInstance()->connexion($email, $password)) {
                        Kernel::getInstance()->addAlert("success","Connexion avec succès. Redirection vers votre compte");
                        header("Refresh: 1;url= ../enterprises/home");
                    }
                }
            } else {
                Kernel::getInstance()->addAlert("warning",
                    "Veuillez remplir tous les champs.");
            }
        }
        $this->template->renderView('home/login');
    }

    public function cookies() {
        $this->template->addVariable("keywords", "Adopteunstage, cookies, rgpd, données, utilisation, utilisateurs, informations");
        $this->template->addVariable("description", "Informations sur l'utilisation de vos données.");
        $this->template->addVariable("title", "Adopteunstage - Cookies");

        $this->template->renderView('home/cookies');
    }
    
    public function about() {
        $this->template->addVariable("keywords", "Adopteunstage, à propos, information, nous");
        $this->template->addVariable("description", "À propos de Adopteunstage.");
        $this->template->addVariable("title", "Adopteunstage - À propos");

        $this->template->renderView('home/about');
    }

    public function logout() {
        session_start();
        $_SESSION = array();

        session_destroy();
        header('location: login');
    }
}