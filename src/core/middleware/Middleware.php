<?php

namespace Skeleton\Core\Middleware;

use Skeleton\Core\Router\Request;
use Skeleton\Core\Router\Response;

interface Middleware
{
    public function handle(Request &$request, Response &$response);
}
