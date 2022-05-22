<?php
require_once('../vendor/autoload.php');

use KaioSouza\PhpRouter\Router;

$router = new Router();

$router->get('/', function () use ($router) {
    echo "Hello World";
}, 'home');

$router->get('/products', function () {
    echo 'My Products';
}, 'products');

$router->get('/products/{category}', function ($category) {
    echo "Current Category: {$category}";
}, 'category');


$router->listen();
