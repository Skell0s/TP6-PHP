<?php
    require_once('Psr4AutoloaderClass.php');

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    $loader = new Helpers\Psr4AutoloaderClass();
    $loader->register();
?>