<?php


namespace KaioSouza\PhpRouter\Exceptions;


use Throwable;

class DuplicatedRouteException extends \Exception
{
    public function __construct($route = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct("Duplicated {$route} route", $code, $previous);
    }
}