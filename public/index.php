<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require '../vendor/autoload.php';

use Skeleton\Api\{User};
use Skeleton\Core\Router\{Router, Request};


$router = new Router();

$router->append(Request::GET, "/skeleton/{section}/", [User::class, 'login']);

$router->attend();
