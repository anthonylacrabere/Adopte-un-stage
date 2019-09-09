<?php

namespace Model;

use Kernel\Kernel;

class InternsModel
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

    public function newRegistration($firstname, $lastname, $email, $password, $gender) {
        $vkey = time().$firstname;

        $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO interns (firstname, lastname, email, password, gender, vkey) 
        VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $gender, $vkey]);

        $subject = "Adopte un stage - Validation de votre compte";
        $body = "Bonjour, $firstname.
        <br>Nous avons bien reçu votre demande d'inscription !
        <br>Afin de finaliser votre inscription, 
        <a href='http://localhost:8888/Adopteunstage-main/public/interns/welcome&vkey={$vkey}'>cliquez ici</a> !";

        Kernel::getInstance()->sendEmail($email, $subject, $body);
    }

    public function connexion($email, $password) {
        if (isset($email) && isset($password)) {
            $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM interns WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() == 1) {
                $result = $stmt->fetch();

                $id = $result->id;
                $firstname = $result->firstname;
                $lastname = $result->lastname;
                $mail = $result->email;
                $pass = $result->password;
                $verif = $result->verified;

                if (password_verify($password, $pass)) {
                    if($verif == 1) {
                        $_SESSION['auth'] = 1;
                        $_SESSION['user_id'] = $id;
                        $_SESSION['firstname'] = $firstname;
                        $_SESSION['lastname'] = $lastname;
                        $_SESSION['email'] = $mail;
                        $_SESSION['status'] = "intern";
                    } else {
                        Kernel::getInstance()->addAlert('danger', 
                        'Compte inactif - Veuillez vérifier vos mails, vous avez reçu un lien de vérification !');
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

    public function isIntern() {
        if($_SESSION["status"] == "intern") {
            return true;
        }
        return false;
    }
    
    public function getInterns() {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT i.id, firstname, lastname, email, gender, age, phone, avatar, speech, verified, vkey, register_date, isAdmin, addresse_name as addresse, aa.name as activity, s.name as skill, level FROM interns i
        JOIN interns_addresses ia ON i.id = ia.intern_id
        JOIN interns_activity_area iaa ON ia.intern_id = iaa.intern_id
        JOIN activity_area aa ON aa.id = iaa.activity_area_id
        JOIN interns_skills isk ON isk.intern_id = i.id
        JOIN skills s ON s.id = isk.skill_id
        JOIN interns_qualifications_level iql ON i.id = iql.intern_id
        JOIN qualifications_level ql ON ql.id = iql.qualification_level_id");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getInternsEvenIfNotCompleted() {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM interns");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getInternById($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT *
        FROM interns i
        WHERE i.id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function getInternInfoById($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT i.id, firstname, lastname, email, gender, age, phone, avatar, speech, verified, vkey, register_date, isAdmin, addresse_name as addresse, aa.name as activity, s.name as skill, level 
        FROM interns i
        JOIN interns_addresses ia ON i.id = ia.intern_id
        JOIN interns_activity_area iaa ON ia.intern_id = iaa.intern_id
        JOIN activity_area aa ON aa.id = iaa.activity_area_id
        JOIN interns_skills isk ON isk.intern_id = i.id
        JOIN skills s ON s.id = isk.skill_id
        JOIN interns_qualifications_level iql ON i.id = iql.intern_id
        JOIN qualifications_level ql ON ql.id = iql.qualification_level_id
        WHERE i.id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function likeEnterprise($intern_id, $enterprise_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM matches WHERE enterprise_id = ? AND intern_id = ?");
        $stmt->execute([$enterprise_id, $intern_id]);

        if($stmt->rowCount() == 1) {
                $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE matches SET intern_like = ? WHERE enterprise_id = ? AND intern_id = ?");
                $stmt->execute([1, $enterprise_id, $intern_id]);
            
        } else {
            $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO matches (intern_id, enterprise_id, intern_like) VALUES (?, ?, ?)");
            $stmt->execute([$intern_id, $enterprise_id, 1]);

        }  
    }

    public function internProfilIsCompleted($id) {
        if($this->getInternInfoById($id)) {
            return true;
        } else {
            return false;
        }
    }


    public function setInternSpeech($id, $speech) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET speech = ? WHERE id = ?");
        $stmt->execute([$speech, $id]);
    }

    public function setInternAvatar($id, $avatar) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET avatar = ? WHERE id = ?");
        $stmt->execute([$avatar, $_id]);
    }

    public function getInternAddresse($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM interns_addresses WHERE intern_id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function addInternAddresse($id, $addresseName) {
        // Check if the user already have a address
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM interns_addresses WHERE intern_id = ?");
        $stmt->execute([$id]);

        // if yes update
        if($stmt->rowCount() == 1) {
            $this->setInternAddresse($id, $addresseName);
        } else {

            // if not then add it
            $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO interns_addresses (intern_id, addresse_name) VALUES (?, ?)");
            $stmt->execute([$id, $addresseName]);

        }
    }

    public function setInternAddresse($id, $addresseName) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns_addresses SET addresse_name = ? WHERE intern_id = ?");
        $stmt->execute([$addresseName, $id]);
    }

    public function updateInternFirstName($id, $firstname) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET firstname = ? WHERE id = ?");
        $stmt->execute([$firstname, $id]);
    }

     public function updateInternAge($id, $age) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET age = ? WHERE id = ?");
        $stmt->execute([$age, $id]);
    }

    public function updateInternLastName($id, $lastname) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET lastname = ? WHERE id = ?");
        $stmt->execute([$lastname, $id]);
    }

    public function getInternPhone($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT phone FROM interns WHERE intern_id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function updateInternPhone($id, $phone) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET phone = ? WHERE id = ?");
        $stmt->execute([$phone, $id]);
    }

    public function addInternAvatar($intern_id) {

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

        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns SET avatar = ? WHERE id = ?");
        $stmt->execute([$newFileName, $intern_id]);
    }





    public function addIntern($firstname, $lastname, $email, $password, $gender, $age, $phone, $verified) {
        $validmail = Kernel::getInstance()->getPdo()->prepare("SELECT email FROM interns WHERE email = ?");
        $validmail->execute([$email]);

        if (!$validmail->fetch()) {
            $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO interns (firstname, lastname, email, password, gender, age, phone, verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $gender, $age, $phone, $verified]);

            return true;
        }

        return false;
    }

    public function deleteIntern($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("DELETE FROM `interns` WHERE id = ?");
        $stmt->execute([$id]);
    }


}