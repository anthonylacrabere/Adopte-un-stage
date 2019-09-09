<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require './Kernel/Autoloader.php';

spl_autoload_register('Autoloader::register');
use Kernel\Core;

$core = new Core();
$core->initCore();

