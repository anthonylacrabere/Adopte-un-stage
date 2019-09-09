<?php
namespace Kernel;

use Controller\IndexController;

class Core
{
    public function initCore() {
        $parameters = $_GET;

        $kernel = Kernel::getInstance();

        if (!isset($parameters['controller']) || !isset($parameters['action'])) {
            $indexController = new IndexController();
            $indexController->home();
            return;
        }

        $kernel->initPdo();

        $request = new Request();
        $request->throwNewRequest($parameters);
    }
}