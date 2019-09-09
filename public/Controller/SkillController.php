<?php


namespace Controller;


use Kernel\AbstractController;
use Model\SkillModel;
use PDO;

class SkillController extends AbstractController
{
    public function __construct() {
        parent::__construct();
    }

    public function deleteSkill() {
        SkillModel::getInstance()->deleteSkillById($_GET["id"]);
    }

    public function addSkill () {
        SkillModel::getInstance()->addSkillById($_POST["skillName"]);
        $lastID = SkillModel::getInstance()->lastID();
        echo '{
            "name":"' . "{$_POST["skillName"]}" .'",
            "id":' . "{$lastID}".'
        }';
    }

}