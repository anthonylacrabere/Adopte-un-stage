<?php
namespace Controller;

use Kernel\AbstractController;
use Kernel\Kernel;
use Model\MpModel;

class MpController extends AbstractController
{
    public function __construct() {
        parent::__construct();
    }

    public function getMp() {
        $data = MpModel::getInstance()->getMp($_SESSION["user_id"], $_GET["id"]);
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data);
    }

    public function createMp() {
        MpModel::getInstance()->createMp($_SESSION["user_id"], $_GET["id"], Kernel::getInstance()->clean($_POST["mp"]));
    }

}