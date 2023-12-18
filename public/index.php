<?php

require_once dirname(__DIR__).'/vendor/autoload.php';


use Framework\Http\Request;
use Framework\Http\Response;


$request = Request::createFromGlobals();


$content = '<h1>Hello, World!</h1>';

$response = new Response($content, 200, []);

print  $response->send();