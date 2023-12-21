<?php

define('BASE_PATH',dirname(__DIR__) );

require_once BASE_PATH.'/vendor/autoload.php';

use Framework\Http\Kernel;
use Framework\Http\Request;


$request = Request::createFromGlobals();

/** @var \League\Container\Container $container */
$container = require BASE_PATH.'/config/services.php';

$kernel = $container->get(Kernel::class);

$response = $kernel->handle($request);


$response->send();