<?php

namespace Model;

use Kernel\Kernel;

class MpModel
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

    public function getMp($exp, $dest) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT message, date, dest, exp
        FROM mp
        WHERE exp = ? OR ?
        AND dest = ? OR ?");
        $stmt->execute([$exp, $dest, $exp, $dest]);

        return $stmt->fetchAll();
    }

    public function createMp($exp, $dest, $message) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO mp (exp, dest, message) VALUES (?, ?, ?)");
        $stmt->execute([$exp, $dest, $message]);
    }
}