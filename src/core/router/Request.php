<?php

namespace Skeleton\Core\Router;

class Request
{
    const GET = 0;
    const POST = 1;
    const PUT = 2;
    const PATCH = 3;
    const DELETE = 4;
    const COPY = 5;
    const HEAD = 6;
    const OPTIONS = 7;
    const LINK = 8;
    const UNLINK = 9;
    const PURGE = 10;
    const LOCK = 11;
    const UNLOCK = 12;
    const PROPFIND = 13;
    const VIEW = 14;

    private array $headers;
    private int $method;
    private string $protocol;
    private string $uri;
    private string $host;
    private $body;

    public function __construct(){
        $input = file_get_contents('php://input');
        $temp = file_get_contents('php://temp');
    }
}