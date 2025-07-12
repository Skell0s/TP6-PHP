<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once('Helpers/Psr4AutoloaderClass.php');

    $loader = new Helpers\Psr4AutoloaderClass();
    $loader->register();

    $loader->addNamespace('\Helpers', '/Helpers');
    $loader->addNamespace('League\Plates', 'Vendor/Plates/src');
    $loader->addNamespace('\Controllers', '/Controllers');
    
    use League\Plates\Engine;
    use Controllers\MainController;

    $templates = new Engine('Views');
    
    $controller = new MainController($templates);
    $controller->index();
    ?>