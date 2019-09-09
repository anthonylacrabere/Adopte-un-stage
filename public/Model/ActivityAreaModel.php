<?php


namespace Model;


use Kernel\Kernel;

class ActivityAreaModel
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


    public function getActivityArea() {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM activity_area ORDER BY name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getInternActivityArea($intern_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM activity_area INNER JOIN interns_activity_area ON activity_area.id = interns_activity_area.activity_area_id WHERE intern_id = ?");
        $stmt->execute([$intern_id]);

        return $stmt->fetch();
    }

    public function addInternActivityArea($intern_id, $activityId) {
        // Check if the user already have activity area
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM activity_area INNER JOIN interns_activity_area ON activity_area.id = interns_activity_area.activity_area_id WHERE intern_id = ?");
        $stmt->execute([$intern_id]);

        if($stmt->rowCount() == 1) {
            $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns_activity_area SET activity_area_id = ? WHERE intern_id = ?");
            $stmt->execute([$activityId, $intern_id]);
        } else {
            $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO interns_activity_area (activity_area_id, intern_id) VALUES (?, ?)");
            $stmt->execute([$activityId, $intern_id]);
        }
    }

    public function getEnterpriseActivityArea($enterprise_id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM activity_area INNER JOIN enterprises_activity_area ON activity_area.id = enterprises_activity_area.activity_area_id WHERE enterprise_id = ?");
        $stmt->execute([$enterprise_id]);

        return $stmt->fetch();
    }

    public function addEnterpriseActivityArea($enterprise_id, $activityId) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO enterprises_activity_area (activity_area_id, enterprise_id) VALUES (?, ?)");
        $stmt->execute([$activityId, $enterprise_id]);
    }

    public function updateEnterpriseActivityArea($enterprise_id, $activityId) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE enterprises_activity_area SET activity_area_id = ? WHERE enterprise_id = ?");
        $stmt->execute([$activityId, $enterprise_id]);
    }
}