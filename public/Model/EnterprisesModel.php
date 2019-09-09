<?php

namespace Model;

use Kernel\Kernel;

class EnterprisesModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function newRegistration($enterprise_name, $email, $password) {
        $vkey = time().$enterprise_name;

        $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO enterprises (enterprise_name, email, password, vkey) VALUES (?, ?, ?, ?)");
        $stmt->execute([$enterprise_name, $email, password_hash($password, PASSWORD_DEFAULT), $vkey]);

        $subject = "Adopte un stage - Validation de votre compte";
        $body = "Bonjour ambassadeur de $enterprise_name.
                <br>Nous avons bien reçu votre demande d'inscription !
                <br>Afin de finaliser votre inscription, <a href='http://localhost:8888/Adopteunstage-main/public/enterprises/welcome&vkey={$vkey}'>cliquez ici</a> !";

        Kernel::getInstance()->sendEmail($email, $subject, $body);
    }

    public function connexion($email, $password) {
        if (isset($email) && isset($password)) {
            $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM enterprises WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() == 1) {
                $result = $stmt->fetch();

                $id = $result->id;
                $enterprise_name = $result->enterprise_name;
                $mail = $result->email;
                $pass = $result->password;
                $verif = $result->verified;

                if (password_verify($password, $pass)) {
                    if($verif == 1) {
                        $_SESSION['auth'] = 1;
                        $_SESSION['user_id'] = $id;
                        $_SESSION['enterprise_name'] = $enterprise_name;
                        $_SESSION['email'] = $mail;
                        $_SESSION['status'] = "enterprise";
                    } else {
                        Kernel::getInstance()->addAlert('danger', 'Compte inactif - Veuillez vérifier vos mails, vous avez reçu un lien de vérification !');
                        return false;
                    }
                    return true;
                }
            }
            Kernel::getInstance()->addAlert('danger', 'Vos identifiants sont incorrect');
            return false;
        }
        return false;
    }

    public function updateEnterpriseName($id, $enterprise_name) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises SET enterprise_name = ? WHERE id = ?");
        $stmt->execute([$enterprise_name, $id]);
    }

    public function updateEnterprisePhone($id, $phone) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises SET phone = ? WHERE id = ?");
        $stmt->execute([$phone, $id]);
    }

    public function getEnterpriseAddresse($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM enterprises_addresses WHERE enterprise_id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function addEnterpriseAddresse($id, $addresseName) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO enterprises_addresses (enterprise_id, addresse_name) VALUES (?, ?)");
        $stmt->execute([$id, $addresseName]);
    }

    public function updateEnterpriseAddresse($id, $addresseName) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises_addresses SET addresse_name = ? WHERE enterprise_id = ?");
        $stmt->execute([$addresseName, $id]);
    }

    public function updateEnterpriseBio($id, $bio) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises SET bio = ? WHERE id = ?");
        $stmt->execute([$bio, $id]);
    }

    public function updateEnterpriseJobTitle($id, $jobTitle) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises SET job_title = ? WHERE id = ?");
        $stmt->execute([$jobTitle, $id]);
    }



    public function addEnterpriseAvatar($enterprise_id) {
        // get details of the uploaded file
        $fileTmpPath = $_FILES['avatar']['tmp_name'];
        $fileName = $_FILES['avatar']['name'];
        $fileSize = $_FILES['avatar']['size'];
        $fileType = $_FILES['avatar']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            $uploadFileDir = 'assets/img/';
            $dest_path = $uploadFileDir . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $message ='Success';
            }
            else {
                $message = 'Fail';
            }
        }

        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises SET avatar = ? WHERE id = ?");
        $stmt->execute([$newFileName, $enterprise_id]);
    }

    public function getEnterprises() {
        $stmt = Kernel::getInstance()->getPdo()->prepare("
        SELECT e.id, addresse_name, avatar, bio, email, enterprise_name, isAdmin, job_title, name as activity, phone, register_date, verified, vkey  
        FROM enterprises e 
        JOIN enterprises_addresses ea ON e.id = ea.enterprise_id 
        JOIN enterprises_activity_area eaa ON e.id = eaa.enterprise_id
        JOIN activity_area aa ON aa.id = eaa.activity_area_id");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getEnterprisesEvenIfNotCompleted() {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM enterprises");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getEnterpriseById($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT *
        FROM enterprises e
        WHERE e.id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }
    
    public function getEnterpriseInfoById($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT e.id, addresse_name, avatar, bio, email, enterprise_name, isAdmin, job_title, name as activity, phone, register_date, verified, vkey  FROM enterprises e 
        JOIN enterprises_addresses ea ON e.id = ea.enterprise_id 
        JOIN enterprises_activity_area eaa ON e.id = eaa.enterprise_id
        JOIN activity_area aa ON aa.id = eaa.activity_area_id
        WHERE e.id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function enterpriseProfilIsCompleted($id) {
        if($this->getEnterpriseInfoById($id)) {
            return true;
        } else {
            return false;
        }
    }

    public function likeIntern($enterprise_id, $intern_id) {
        // Check if the user already have a address
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM matches WHERE enterprise_id = ? AND intern_id = ?");
        $stmt->execute([$enterprise_id, $intern_id]);

        // if yes update
        if($stmt->rowCount() == 1) {
                $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE matches SET enterprise_like = ? WHERE enterprise_id = ? AND intern_id = ?");
                $stmt->execute([1, $enterprise_id, $intern_id]);
            
        } else {
            // if not then add it
            $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO matches (intern_id, enterprise_id, enterprise_like) VALUES (?, ?, ?)");
            $stmt->execute([$intern_id, $enterprise_id, 1]);
        }
    }
    
    public function createEnterprise($enterprise_name, $email, $password, $verified) {
        $validmail = Kernel::getInstance()->getPdo()->prepare("SELECT email FROM enterprises WHERE email = ?");
        $validmail->execute([$email]);

        if (!$validmail->fetch()) {
            $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO enterprises (enterprise_name, email, password, verified) VALUES (?, ?, ?, ?)");
            $stmt->execute([$enterprise_name, $email, password_hash($password, PASSWORD_DEFAULT), $verified]);

            return true;
        }

        return false;
    }
    
    public function deleteEnterprise($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("DELETE FROM `enterprises` WHERE id = ?");
        $stmt->execute([$id]);
    }
}