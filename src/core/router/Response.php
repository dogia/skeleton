<?php

namespace Skeleton\Core\Router;

class Response
{
    public static bool $encodeByDefaultUsingJson = true;
    public int $status;
    private array $cookies;
    private array $headers;
    private $content;
    public $callback;


    public function __construct()
    {
        $this->status = 200;
        $this->cookies = [];
        $this->headers = [];
        $this->content = '';
    }

    public function __destruct()
    {
        foreach($this->cookies as $name => $cookie)
        {
            setcookie($name, $cookie['value'], $cookie['expires'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
        }

        foreach($this->headers as $header)
        {
            header($header, true);
        }

        http_response_code($this->status);
        echo $this->content;

        if(is_callable($this->callback))
            $this->callback();
    }

    public function respond($content)
    {
        $type = gettype($content);
        if($type == 'string'){
            $this->content = $content;
        }else if ($type == 'array'){
            if(self::$encodeByDefaultUsingJson)
            {
                $this->json($content);
            }else{
                $this->xml($content);
            }
        }
    }
    public function json($content)
    {
        $this->header("Content-Type: application/json; charset=UTF-8");
        $this->content = json_encode($content);
    }

    public function xml($content)
    {
        $this->content = xmlrpc_encode($content);
    }

    public function withStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function withCookie(string $name, string $value = '', int $expires = 0, string $path = '', string $domain = '', bool $secure = false, bool $httponly = false)
    {
        $this->cookies[$name] = [
            'value' => $value,
            'expires' => $expires,
            'path' => $path,
            'domain' => $domain,
            'secure' => $secure,
            'httponly' => $httponly
        ];
    }

    public function deleteCookie($name)
    {
        $this->withCookie($name);
        return $this;
    }

    public function header($header)
    {
        $this->headers[] = $header;
        return $this;
    }
}