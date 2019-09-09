<?php

namespace Model;

use Kernel\Kernel;

class MatchesModel
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

    public function getMatches() {

    }

    public function getInternMatchesByID($intern_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM matches WHERE intern_id = ? AND intern_like = ?");
        $stmt->execute([$intern_id, 1]);

        return $stmt->fetchAll();
    }

    public function getEnterpriseMatchesByID($enterprise_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM matches WHERE enterprise_id = ? AND enterprise_like = ?");
        $stmt->execute([$enterprise_id, 1]);

        return $stmt->fetchAll();
    }

    public function verifMatch($match_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM matches WHERE id = ?");
        $stmt->execute([$match_id]);

        $match = $stmt->fetch();

        if($match->intern_like == 1 & $match->enterprise_like == 1) {
            return true;
        } else {
            return false;
        }
    }

}