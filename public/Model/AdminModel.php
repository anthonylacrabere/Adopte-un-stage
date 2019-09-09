<?php


namespace Model;

use Kernel\Kernel;

class AdminModel
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

    public function isAdmin($user_id) {
        if(InternsModel::getInstance()->isIntern()) {
            $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM interns WHERE isAdmin = ? AND id = ?");
            $stmt->execute([1, $user_id]);
            if($stmt->rowCount() == 1) {
                return true;
            }
        } else {
            $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM enterprises WHERE isAdmin = ? AND id = ?");
            $stmt->execute([1, $user_id]);
            if($stmt->rowCount() == 1) {
                return true;
            }
        }
        return false;       
    }

    public function isConnected() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['auth']);
    }
}