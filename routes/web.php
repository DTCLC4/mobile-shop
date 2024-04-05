<?php declare (strict_types = 1);

use App\Http\Controllers\HomeController;

// $router->addRoute('GET', '/con-heo-con', function(){
//     echo 'đi bằng hai chân';
// });

$router->addRoute('GET', '/con-chim-non', [HomeController::class, 'index']);
