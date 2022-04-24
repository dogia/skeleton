<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../vendor/autoload.php';

use Skeleton\Api\{User};
use Skeleton\Core\Router\{Router, Request, Response};


$router = new Router('/skeleton/public');

$router->append(Request::GET, "/{section}", [User::class, 'login']);
$router->append(Request::GET, "/{otraseccion}/{o}", function(Response $response){
    $response->setContent("Contenido");
});

$router->attend();

new Request();
