<?php


use Doctrine\DBAL\Connection;
use Framework\Console\Application;
use Framework\Console\Commands\MigrateCommand;
use Framework\Controller\AbstractController;
use Framework\Dbal\ConnectionFactory;
use Framework\Http\Kernel;
use Framework\Http\Middleware\RequestHandler;
use Framework\Http\Middleware\RequestHandlerInterface;
use Framework\Session\SessionInterface;
use Framework\Template\TwigFactory;
use League\Container\Argument\Literal\ArrayArgument;
use League\Container\Argument\Literal\StringArgument;
use League\Container\Container;
use Framework\Routing\RouterInterface;
use Framework\Routing\Router;
use League\Container\ReflectionContainer;
use Symfony\Component\Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use \Framework\Console\Kernel as ConsoleKernel;

$dotenv = new Dotenv();
$dotenv->load(BASE_PATH.'/.env');



// applications parameters
$routes = include BASE_PATH . '/routes/web.php';
$appEnv = $_ENV['APP_ENV'] ?? 'local';
$viewsPath = BASE_PATH.'/views';
$databaseUrl = 'pdo-mysql://lemp:lemp@database:3306/lemp?charset=utf8mb4';
// application services


$container = new Container();

$container->delegate(new ReflectionContainer(true));

$container->add('framework-commands-namespace',new StringArgument('Framework\\Console\\Commands\\'));


$container->add('APP_ENV', new StringArgument($appEnv));


$container->add(RouterInterface::class,Router::class);

$container->extend(RouterInterface::class)
    ->addMethodCall('registerRoutes',[new ArrayArgument($routes)]);

$container->add(RequestHandlerInterface::class, RequestHandler::class);

$container->add(Kernel::class)
    ->addArguments([
        RouterInterface::class,
        $container,
        RequestHandlerInterface::class
    ]);



$container->addShared(SessionInterface::class,Framework\Session\Session::class);
$container->add('twig-factory', TwigFactory::class)
    ->addArguments([
       new StringArgument($viewsPath),
        SessionInterface::class
    ]);

$container->addShared('twig', function () use ($container){
   return $container->get('twig-factory')->create();
});

$container->inflector(AbstractController::class)
    ->invokeMethod('setContainer', [$container]);

$container->add(ConnectionFactory::class)
    ->addArgument(new StringArgument($databaseUrl));

$container->addShared(Connection::class, function () use ($container): Connection {
    return  $container->get(ConnectionFactory::class)->create();
});

$container->add(Application::class)
    ->addArgument($container);

$container->add(ConsoleKernel::class)
    ->addArgument($container)
    ->addArgument(Application::class);

$container->add('console:migrate', MigrateCommand::class)
    ->addArgument(Connection::class)
    ->addArgument(new StringArgument(BASE_PATH . '/database/migrations'));



return $container;