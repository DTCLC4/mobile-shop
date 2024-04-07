<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$dependenciesFilePath = __DIR__ . '/../app/dependencies.php';

$environment = 'dev';

/**
* Register the error handler
*/
$whoops = new \Whoops\Run;
if ($environment !== 'prod') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'internal server error';
    });
}
$whoops->register();

$injector = include(__DIR__ . '/../app/dependencies.php');

$request = $container->get('Symfony\Component\HttpFoundation\Request');
$response = $container->get('Symfony\Component\HttpFoundation\Response');

$controller = $container->get('App\Http\Controllers\HomeController');
$controller->index();


$dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $router) {
  include '../routes/web.php';
});

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

switch ($routeInfo[0]) {
  case \FastRoute\Dispatcher::NOT_FOUND:
    $response->setContent('404 - Page not found');
    $response->setStatusCode(404);
    break;
  case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $response->setContent('405 - Method not allowed');
    $response->setStatusCode(405);
    break;
  case \FastRoute\Dispatcher::FOUND:
    $response->setStatusCode(200);
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    if (is_array($handler) && count($handler) === 2 && method_exists($handler[0], $handler[1])) {
      // Nếu handler là một mảng chứa tên lớp và tên phương thức hợp lệ
      $class = $injector->make($handler[0]);
      $method = $handler[1];
      $class->$method($vars);
    } else {
      // Nếu handler không hợp lệ
      var_dump($handler);
      $response->setContent('500 - Lỗi máy chủ nội bộ: Callback không hợp lệ');
      $response->setStatusCode(500);
    }
    break;
}



$response->prepare($request);
$response->send();
