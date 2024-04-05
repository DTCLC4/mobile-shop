<?php

declare(strict_types=1);

use DI\ContainerBuilder;

// Tạo một ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Định nghĩa các dependency
$containerBuilder->addDefinitions([
  'Symfony\Component\HttpFoundation\Request' => function () {
      return Symfony\Component\HttpFoundation\Request::createFromGlobals();
  },
  'Symfony\Component\HttpFoundation\Response' => function () {
      return new Symfony\Component\HttpFoundation\Response();
  },
  'App\Contracts\BirdServiceInterface' => DI\autowire('App\Services\BirdService')
]);

// Tạo container từ ContainerBuilder
$container = $containerBuilder->build();

// Trả về container
return $container;
