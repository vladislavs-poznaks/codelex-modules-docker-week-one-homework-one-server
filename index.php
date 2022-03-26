<?php

use App\Http\Controllers\CountController;
use App\Http\Request;

require_once 'vendor/autoload.php';

session_start();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/increment', [CountController::class, 'increment']);
    $r->addRoute('GET', '/decrement', [CountController::class, 'decrement']);
});

$request = new Request();

[$response, $handler, $vars] = $dispatcher->dispatch($request->method(), $request->uri());

switch ($response) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo 'NOT FOUND';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo 'NOT ALLOWED';
        break;
    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = $handler;

        (new $controller)->{$method}();

        break;
}
