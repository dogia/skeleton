<?php

namespace Skeleton\Api;

use Skeleton\Core\Router\{Response, Request};

class User
{
    public function login(Response $response, Request $request, $section)
    {
        echo "login called at $section";
    }
}