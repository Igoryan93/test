<?php

if( !session_id() ) @session_start();

require_once "../vendor/autoload.php";
use DI\Container;
$container = new Container;

//$templates = new Engine('../app/views/');
//
//echo $templates->render('about', ['name' => $user['username']]);


//
//flash()->info(['Info message', 'Second Info message']); /* Запись типа и текста сообщения */
//flash()->success(['Success message']);
//flash()->warning(['Warning message']);
//flash()->error(['Error message']);


//echo flash()->display(); /* Вывод всех записанных сообщений */


/* Routing */
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/home', ['App\Controllers\HomeController', 'index']);
    $r->addRoute('GET', '/about', ['App\Controllers\HomeController', 'about']);
    $r->addRoute('GET', '/emailverify', ['App\Controllers\HomeController', 'email_verification']);
    $r->addRoute('GET', '/login', ['App\Controllers\HomeController', 'login']);
    $r->addRoute('GET', '/logout', ['App\Controllers\HomeController', 'logOut']);
    $r->addRoute('GET', '/mailer', ['App\Controllers\HomeController', 'sendEmail']);
    $r->addRoute('GET', '/insert', ['App\Controllers\HomeController', 'insert']);
    $r->addRoute('GET', '/page/{page:\d+}', ['App\Controllers\HomeController', 'index']);

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);


$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo 'Error 404';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo 'Error 405, Method is not GET';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $cont = $container->call($routeInfo[1], $routeInfo[2]);
        d($cont);
        break;
}

