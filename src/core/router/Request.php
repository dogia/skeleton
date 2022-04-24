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
    const OPTIONS = 6;
    const LINK = 7;
    const UNLINK = 8;
    const PURGE = 9;
    const LOCK = 10;
    const UNLOCK = 11;
    const PROPFIND = 12;
    const VIEW = 13;

    private array $cookies;
    private array $headers;
    private int $method;
    private $url;
    private $body;

    private function loadHeaders()
    {
        $this->headers = array();
        foreach(getallheaders() as $key =>  $value)
        {
            $this->headers[$key] = $value;
        }
    }

    private function loadMethod()
    {
        switch($_SERVER['REQUEST_METHOD'])
        {
            case 'GET': $this->method = self::GET; break;
            case 'POST': $this->method = self::POST; break;
            case 'PUT': $this->method = self::PUT; break;
            case 'PATCH': $this->method = self::PATCH; break;
            case 'DELETE': $this->method = self::DELETE; break;
            case 'COPY': $this->method = self::COPY; break;
            case 'OPTIONS': $this->method = self::OPTIONS; break;
            case 'LINK': $this->method = self::LINK; break;
            case 'UNLINK': $this->method = self::UNLINK; break;
            case 'PURGE': $this->method = self::PURGE; break;
            case 'LOCK': $this->method = self::LOCK; break;
            case 'UNLOCK': $this->method = self::UNLOCK; break;
            case 'PROPFIND': $this->method = self::PROPFIND; break;
            case 'VIEW': $this->method = self::VIEW; break;
        }
    }

    public function __construct()
    {
        $this->cookies = $_COOKIE;
        $this->loadHeaders();
        $this->loadMethod();
        $this->url = parse_url($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        $this->body = file_get_contents('php://input');
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getHeader($header)
    {
        foreach($this->headers as $key => $value)
        {
            if($key === $header)
            {
                return $value;
            }
        }
        return false;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getCookies()
    {
        return $this->cookies;
    }

    public function getCookie($name)
    {
        foreach($this->cookies as $key => $value)
            if($key === $name)
                return $value;
        return false;
    }
}