<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../vendor/autoload.php';

use Skeleton\Api\{User};
use Skeleton\Core\Router\{Router, Request};


$router = new Router('/skeleton/public/login');

$router->append(Request::GET, "/{section}", [User::class, 'login']);
$router->append(Request::GET, "/{otraseccion}/{o}", function($otraseccion, $o){
    echo "____ $otraseccion no se ejecuta $o";
});

$router->attend();
