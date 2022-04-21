<?php

namespace Skeleton\Core\Router;

class Router
{
    private array $routes;
    private string $root;

    public function __construct(string $root = '')
    {
        $this->root = $root;
        $this->routes = array();
    }

    public function append(int $method, string $url, $handler): void
    {
        $this->routes[] = new Route($method, $this->root.$url, $handler);
    }

    private function match($url): bool
    {
        return $this->root == '' || strpos($url, $this->root) !== false;
    }

    public function attend()
    {
        $url = $_SERVER['REQUEST_URI'];

        foreach($this->routes as $route)
        {
            if($route->match($url)){
                $route->handle();
            }
        }
    }
}
