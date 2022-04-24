<?php

namespace Skeleton\Api;

use Skeleton\Core\Router\{Response, Request};

class User
{
    public function login(Response $response, Request $request, $section)
    {
        $response->respond("texto");
        $response->deleteCookie('algo');
        return $response;
    }
}