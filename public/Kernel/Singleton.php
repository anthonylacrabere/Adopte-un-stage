<?php
namespace Kernel;

class Singleton
{
    private static $instance = null;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if (is_null(Singleton::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}