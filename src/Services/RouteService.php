<?php


namespace KaioSouza\PhpRouter\Services;


use KaioSouza\PhpRouter\Constants\Config;
use KaioSouza\PhpRouter\Exceptions\DuplicatedRouteException;
use KaioSouza\PhpRouter\Exceptions\RouteNotFoundException;

class RouteService
{
    protected $routes;

    protected $namedRoutes = [];

    protected $basePath = '';

    public function __construct(array $config = [])
    {
        $this->basePath = isset($config[Config::BASE_PATH]) ? $config[Config::BASE_PATH] : '';;
    }

    public function map($method, $route, $target, $name = null)
    {
        $this->routes[] = [$method, $route, $target, $name];

        if ($name) {
            if (isset($this->namedRoutes[$name])) {
                throw new DuplicatedRouteException($name);
            }
            $this->namedRoutes[$name] = $route;
        }
        return;
    }


    public function match($requestUrl = null, $requestMethod = null)
    {
        $params = [];

        if ($requestUrl === null) {
            $requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        }

        $requestUrl = substr($requestUrl, strlen($this->basePath));

        if (($strpos = strpos($requestUrl, '?')) !== false) {
            $requestUrl = substr($requestUrl, 0, $strpos);
        }

        $lastRequestUrlChar = $requestUrl ? $requestUrl[strlen($requestUrl) - 1] : '';

        if ($requestMethod === null) {
            $requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
        }

        foreach ($this->routes as $handler) {
            list($methods, $route, $target, $name) = $handler;

            $method_match = (stripos($methods, $requestMethod) !== false);

            if (!$method_match) {
                continue;
            }

            if (($position = strpos($route, '{')) === false) {
                $match = strcmp($requestUrl, $route) === 0;
            } else {
                if (
                    strncmp($requestUrl, $route, $position) !== 0 &&
                    (
                        $lastRequestUrlChar === '/' ||
                        $route[$position - 1] !== '/'
                    ) || count(explode('/', $requestUrl)) != count(explode('/', $route))
                ) {
                    continue;
                }

                $match = $params = $this->matchParams($route, $requestUrl);
            }
            if ($match) {
                return [
                    'target' => $target,
                    'params' => $params,
                    'name' => $name
                ];
            }
        }
        return false;
    }

    private function matchParams($route, $uri)
    {
        $explodedURI = explode('/', $uri);
        $matched = [];

        foreach (explode('/', $route) as $key => $value) {
            if (strpos($value, '}')) {
                $matched[] = $explodedURI[$key];
            }
        }
        return $matched;

    }
}