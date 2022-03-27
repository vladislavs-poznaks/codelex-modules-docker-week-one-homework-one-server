<?php

use App\Http\Controllers\CountController;
use App\Http\Request;
use App\Views\View;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once 'vendor/autoload.php';

session_start();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [CountController::class, 'home']);

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

        $response = (new $controller)->{$method}($vars);

        if ($response instanceof View) {
            $loader = new FilesystemLoader('src/Views');
            $twig = new Environment($loader);

            echo $twig->render($response->getPath(), $response->getVariables());
        }

        break;
}
