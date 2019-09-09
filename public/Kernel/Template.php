<?php
namespace Kernel;

use Controller\IndexController;

class Template
{
    protected $var = [];

    public function renderView($viewName, $templateName = "base") {
        $file = 'View/' . $viewName . '.php'; // container
        $template = 'View/template/' . $templateName . '.php'; // header - footer
        if (file_exists($file)) {
            if (file_exists($template)) {
                ob_start();
                include($file);
                $content = ob_get_clean();
                include($template);
            } else {
                $indexController = new IndexController();
                $indexController->templateNotFound();
            }
        } else {
            $indexController = new IndexController();
            $indexController->pageNotFound();
        }
    }

    public function addVariable($key, $value) {
        $this->var[$key] = $value;
    }
}