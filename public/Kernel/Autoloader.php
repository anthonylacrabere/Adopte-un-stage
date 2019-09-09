<?php


class Autoloader {

    public static function register($className) {
        $file = str_replace('\\', '/', $className) . '.php';
        if (file_exists($file)) {
            include $file;
            return true;
        }

        return false;
    }

}