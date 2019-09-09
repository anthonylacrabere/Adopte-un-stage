<?php
namespace Kernel;

use PDO;
use PDOException;
use Model\InternsModel;
use Model\EnterprisesModel;
use Model\AdminModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

class Kernel extends Singleton
{
    private $pdo = null;

    private $alerts = [];


    /**
     * @return mixed
     */
    public function getPdo() {
        if($this->pdo === null) {
            $this->initPdo();
        }
        return $this->pdo;
    }

    /**
     * Initialization of PDO connection
     */
    public function initPdo() {
        $config = include '../private/config/config.php';

        try {
            $pdoInstance = new PDO(sprintf('mysql:host=%s;dbname=%s', $config["DB_HOST"], $config["DB_NAME"]), $config["DB_USER"],
             $config["DB_PASSWORD"], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);

            $pdoInstance->exec("SET CHARACTER SET utf8");
            $pdoInstance->exec("SET NAMES utf8");
            $this->pdo = $pdoInstance;
        } catch (PDOException $e) {
            $message = "Erreur de base de données.";
            die("<h3>" . $message . "</h3>");
        }
    }

    public function destroyPdo() {
        unset($this->pdo);
    }

    public function sendEmail($targetEmail, $subject, $message) {
        $config = include '../private/config/config.php';

        $mail = new PHPMailer();

        if (true) $mail->isSMTP();
        if (!true) $mail->isMail();

        $mail->Host = $config["SMTPHOST"];
        $mail->SMTPAuth = true;
        $mail->Username = $config["SMTPUSERNAME"];
        $mail->Password = $config["SMTPPASSWORD"];
        $mail->SMTPSecure = $config["SMTPSECURE"];
        $mail->Port = $config["SMTPPORT"];

        $mail->setFrom("anthony.lacra@outlook.fr", "Adopte un stage");
        $mail->addAddress($targetEmail);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->CharSet = 'UTF-8';

        try {
            $mail->send();
        } catch (Exception $e) {
            $error = "Erreur envoie mail : ".$e->getMessage();
        }
    }

    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * type = soit danger soit warning soit success
     *
     * @param $type
     * @param $message
     */
    public function addAlert($type, $message)
    {
        $alert = [
            'type' => $type,
            'message' => $message
        ];
        array_push($this->alerts, $alert);
    }

    public function clean($value) {
        return strip_tags(trim($value));
    }

    public function redirectIfConnected() {
        if(AdminModel::getInstance()->isConnected()) {
            InternsModel::getInstance()->isIntern() 
            ? header('location: http://localhost:8888/Adopteunstage-main/public/interns/home') 
            : header('location: http://localhost:8888/Adopteunstage-main/public/enterprises/home');
        }
    }

    public function redirectIfDisconnected() {
        if (!AdminModel::getInstance()->isConnected()) {
            header('Location: http://localhost:8888/Adopteunstage-main/public/home/login');
            exit();
        }
    }

    public function redirectByStatus($status, $pageName = "home") {
        if($status != $_SESSION["status"]):
            $status == "intern" ? $status = "enterprise" : $status = "intern";
            header("location: ../{$status}s/{$pageName}");
        endif;
    }

    public function redirectIfNotAdmin($user_id) {
        if(!AdminModel::getInstance()->isAdmin($user_id)) {
            InternsModel::getInstance()->isIntern() 
            ? header('location: http://localhost:8888/Adopteunstage-main/public/interns/home') 
            : header('location: http://localhost:8888/Adopteunstage-main/public/enterprises/home');
        }
    }

    public function redirectIfProfilNotCompleted() {
        if(!InternsModel::getInstance()->isIntern()) {
            if(!EnterprisesModel::getInstance()->enterpriseProfilIsCompleted($_SESSION["user_id"])) {
                header("location: http://localhost:8888/Adopteunstage-main/public/enterprises/profil_edit");
                exit();
            }
        } else {
            if(!InternsModel::getInstance()->internProfilIsCompleted($_SESSION["user_id"])) {
                header("location: http://localhost:8888/Adopteunstage-main/public/interns/profil_edit");
                exit();
            }
        }
        
    }

}