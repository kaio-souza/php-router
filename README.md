# php-router
A simple PHP router

## HOW TO CONFIGURE ENVIROMENT
To use the router, you will need to rewrite all requests to a single file in which you create an instance of the router class.

####Apache .htaccess
```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule . index.php [L]
```

####Nginx nginx.conf
```
try_files $uri /index.php;
```

## HOW TO RUN EXAMPLE
On the project folder run

```
php -S localhost:8080 -t ./example
```

## Using the Router
###Instantiate Router
```php
$router = new Router();
```

###Creating Route
```php
$router->get('/xpto', function(){
    echo 'Hello World';
});
```

###Creating Route with Param
```php
$router->get('/xpto/{param}', function($param){
    echo $param;
});
```

###Listen Requests
Add it on final of file
```php
$router->listen();
```