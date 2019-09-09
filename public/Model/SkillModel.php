<?php


namespace Model;


use Kernel\Kernel;

class SkillModel
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

    public function getSkills() {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM skills ORDER BY name ASC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getInternSkill($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM skills INNER JOIN interns_skills ON skills.id = interns_skills.skill_id WHERE intern_id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function addInternSkill($intern_id, $skillId) {
        // Check if the user already have a skill
        $stmt = Kernel::getInstance()->getPdo()->prepare("SELECT * FROM interns_skills WHERE intern_id = ?");
        $stmt->execute([$intern_id]);

        // if yes update
        if($stmt->rowCount() == 1) {
            $stmt = Kernel::getInstance()->getPdo()->prepare("UPDATE interns_skills SET skill_id = ? WHERE intern_id = ?");
            $stmt->execute([$skillId, $intern_id]);
        } else {
            // if not then add it
            $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO interns_skills (skill_id, intern_id) VALUES (?, ?)");
            $stmt->execute([$skillId, $intern_id]);
        }
    }

    public function deleteSkillById($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("DELETE FROM `skills` WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function addSkillById($id) {
        $stmt = Kernel::getInstance()->getPdo()->prepare("INSERT INTO skills (name) VALUES (?)");
        $stmt->execute([$id]);
    }

    public function lastID() {
        return Kernel::getInstance()->getPdo()->lastInsertId();
    }
}