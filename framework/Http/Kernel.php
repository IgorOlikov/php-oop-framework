<?php

namespace Framework\Http;

use FastRoute\RouteCollector;
use Framework\Http\Exceptions\HttpException;
use Framework\Http\Exceptions\MethodNotAllowedException;
use Framework\Http\Exceptions\RouteNotFoundException;
use Framework\Http\Response;

use Framework\Routing\RouterInterface;
use function FastRoute\simpleDispatcher;

class Kernel
{
    public function __construct(private RouterInterface $router)
    {

    }


    public function handle(Request $request): Response
    {
        try {
            [$routeHandler, $vars] = $this->router->dispatch($request);

            $response = call_user_func_array($routeHandler, $vars);
        } catch (HttpException $e) {
            $response = new Response($e->getMessage(), $e->getStatusCode());
        } catch (\Throwable $e) {
            $response = new Response($e->getMessage(), statusCode: 500);
        }
        return $response;
    }
}