<?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    require_once('Helpers/Psr4AutoloaderClass.php');

    $loader = new Helpers\Psr4AutoloaderClass();
    $loader->register();
    $loader->addNamespace('\Helpers', '/Helpers');
    $loader->addNamespace('League\Plates', 'Vendor/Plates/src');
    $templates = new League\Plates\Engine('Views');

    echo $templates->render('home', ['tftSetName' => 'Test']);
    ?>