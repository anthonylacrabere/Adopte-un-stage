<?php
namespace Kernel;

use Controller\IndexController;

class Request {

    public function throwNewRequest($parameters) {
        $indexController = new IndexController();
        $controller = $this->getControllerRequest($parameters['controller']);
        if ($controller === null) {
            $indexController->pageNotFound();
            return;
        }
        $actionCall = $this->getActionRequest($controller, $parameters['action']);
        if ($actionCall === null) {
            $indexController->pageNotFound();
            return;
        }
    }

    public function getControllerRequest($controllerName) {
        $file = sprintf('%sController.php', ucfirst($controllerName));
        if (file_exists(sprintf('Controller/%s', $file))) {
            $class = sprintf('Controller\%sController', ucfirst($controllerName));
            if (class_exists($class)) {
                $controller = new $class();
                return $controller;
            }
        }
        return null;
    }

    public function getActionRequest($controllerObject, $actionName) {
        if (method_exists($controllerObject, $actionName)) {
            $controllerObject->$actionName();
        } else {
            return false;
        }
        return true;
    }
}