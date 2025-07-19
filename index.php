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
    $loader->addNamespace('\Controllers\Router', '/Controllers/Router');
    $loader->addNamespace('\Controllers\Router\Route', '/Controllers/Router/Route');
    $loader->addNamespace('\Models', '/Models');
    $loader->addNamespace('\Config', '/Config');
    
    use Controllers\Router\Router;

    $router = new Router();
    $router->routing($_GET, $_POST);
?>