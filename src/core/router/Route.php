<?php

namespace Skeleton\Core\Router;

use ReflectionFunction;
use ReflectionMethod;
use Skeleton\Core\Router\{Request, Response};

class Route extends Response
{
    private int $method;
    private string $url_query;
    private $handler;
    private array $params;

    public function __construct(int $method, string $url_query, $handler)
    {
        $this->method = $method;
        $this->url_query = $url_query;
        $this->params = array();


        if(is_array($handler))
        {
            $classMethod = function($params) use ($handler) {
                $class = new $handler[0];
                $method = $handler[1];

                $parameters = (new ReflectionMethod($handler[0], $handler[1]))->getParameters();

                $methodParams = [];
                foreach($parameters as $parameter)
                    if(isset($params[$parameter->getName()]))
                        $methodParams[] = $params[$parameter->getName()];
                    else die("Doesn't exists enough arguments to handle this request");

                $class->$method(... $methodParams);
            };
            $this->handler = $classMethod;
        }else{
            $functionHandler = function($params) use ($handler) {
                $parameters = (new ReflectionFunction($handler))->getParameters();
                $fnParams = [];
                foreach($parameters as $parameter)
                    if(isset($params[$parameter->getName()]))
                        $fnParams[] = $params[$parameter->getName()];
                    else die("Doesn't exists enough arguments to handle this request");
                $handler(... $fnParams)->callback();
            };
            $this->handler = $functionHandler;
        }
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    public function match($route)
    {
        // TODO: fix when the url is like /url/home/ and not /url/home
        $query = explode('/', $route);
        $current = explode('/', $this->url_query);

        if(!(count($query) === count($current)))
            return false;

        for($index = 0; $index < count($current); $index++)
        {
            $cWord = $current[$index];
            $qWord = $query[$index];

            $initVar = strpos($cWord, '{');
            $finishVar = strpos($cWord, '}');

            $isVar = $initVar !== false && $finishVar !== false;
            $isVar &= $initVar < $finishVar;
            $isVar &= $finishVar + 1 == strlen($cWord);

            if($isVar){
                $prefixC = substr($cWord, 0, $initVar);
                $prefixQ = substr($qWord, 0, $initVar);

                $nameVar = substr($cWord, ($initVar + 1), $finishVar - $initVar - 1);
                $valueVar = substr($qWord, $initVar);

                if($prefixC != $prefixQ || strlen($nameVar) == 0 || strlen($valueVar) == 0){
                    return false;
                }

                $this->params[$nameVar] = $valueVar;
            }else if($cWord != $qWord){
                return false;
            }
        }

        return true;
    }

    public function middleware()
    {

    }

    public function handle()
    {
        $response = new Response();
        $request = new Request();

        $this->params['response'] = $response;
        $this->params['request'] = $request;

        ($this->handler)($this->params);
    }
}