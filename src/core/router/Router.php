<?php

namespace Skeleton\Core\Router;

class Router
{
    private static $routers = array();
    private static bool $solved;
    private array $routes;
    private string $root;

    public function __construct(string $root = '')
    {
        $this->root = $root;
        $this->routes = array();
        Router::$solved = false;
        Router::$routers[] = $this;
    }

    public function append(int $method, string $url, $handler): Route
    {
        $route = new Route($method, $this->root . $url, $handler);
        $this->routes[] = $route;
        return $route;
    }

    private function match($url): bool
    {
        return ($this->root == '' || strpos($url, $this->root) !== false);
    }

    /**
     * @throws \Exception
     */
    public static function attend()
    {
        $url = $_SERVER['REQUEST_URI'];

        foreach (self::$routers as $router)
        {
            if(!$router->match($url))
                continue;

            foreach($router->routes as $route)
            {
                if($route->match($url) && !self::$solved)
                {
                    self::$solved = true;
                    $route->handle();
                    return;
                }
            }
        }

        throw new \Exception('Route not found!', 404);
    }
}
