<?php


namespace KaioSouza\PhpRouter\Exceptions;


use Throwable;

class RouteNotFoundException extends \Exception
{
    public function __construct($route = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct("Route {$route} not found", $code, $previous);
    }
}