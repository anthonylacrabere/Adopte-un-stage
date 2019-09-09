<?php


namespace Model;


use Kernel\Kernel;

class QualificationsLevelModel
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

    public function getQualificationsLevel() {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM qualifications_level ORDER BY id");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getInternQualificationsLevel($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM qualifications_level INNER JOIN interns_qualifications_level ON qualifications_level.id = interns_qualifications_level.qualification_level_id WHERE intern_id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function addInternQualificationsLevel($intern_id, $qualification_level_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO interns_qualifications_level (intern_id, qualification_level_id) VALUES (?, ?)");
        $stmt->execute([$intern_id, $qualification_level_id]);
    }

    public function updateInternQualificationsLevel($intern_id, $qualification_level_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns_qualifications_level SET qualification_level_id = ? WHERE intern_id = ?");
        $stmt->execute([$qualification_level_id, $intern_id]);
    }


}