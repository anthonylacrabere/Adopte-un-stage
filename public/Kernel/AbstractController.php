<?php


namespace Kernel;


class AbstractController
{
    protected $template;

    public function __construct() {
        $this->template = new Template();
    }
}

