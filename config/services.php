<?php


use Framework\Http\Kernel;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Container;
use Framework\Routing\RouterInterface;
use Framework\Routing\Router;


// applications parameters
$routes = include BASE_PATH . '/routes/web.php';
// application services


$container = new Container();
$container->add(RouterInterface::class,Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('registerRoutes',[new ArrayArgument($routes)]);


$container->add(Kernel::class)
    ->addArgument(RouterInterface::class);



return $container;