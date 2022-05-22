<?php

namespace KaioSouza\PhpRouter;

use KaioSouza\PhpRouter\Constants\Method;
use KaioSouza\PhpRouter\Services\RouteService;

class Router
{
    public $routeService;

    public function __construct(array $config = [])
    {
        $this->routeService = new RouteService($config);
    }

    public function get($route, $action, $name = null)
    {
        $this->routeService->map(Method::GET, $route, $action, $name);
    }

    public function post($route, $action, $name = null)
    {
        $this->routeService->map(Method::POST, $route, $action, $name);
    }

    public function put($route, $action, $name = null)
    {
        $this->routeService->map(Method::PUT, $route, $action, $name);
    }

    public function delete($route, $action, $name = null)
    {
        $this->routeService->map(Method::DELETE, $route, $action, $name);
    }

    public function listen()
    {
        $match = $this->routeService->match();
        if (is_array($match) && is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['params']);
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        }
    }
}