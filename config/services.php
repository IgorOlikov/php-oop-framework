<?php


use Framework\Http\Kernel;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use Framework\Routing\RouterInterface;
use Framework\Routing\Router;
use League\Container\ReflectionContainer;


// applications parameters
$routes = include BASE_PATH . '/routes/web.php';
// application services


$container = new Container();

$container->delegate(new ReflectionContainer(true));

$container->add('APP_ENV', new StringArgument('local'));


$container->add(RouterInterface::class,Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('registerRoutes',[new ArrayArgument($routes)]);


$container->add(Kernel::class)
    ->addArgument(RouterInterface::class)
    ->addArgument($container);


return $container;