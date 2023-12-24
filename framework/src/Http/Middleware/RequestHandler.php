<?php

namespace Framework\Http\Middleware;

use Framework\Http\Request;
use Framework\Http\Response;

class RequestHandler implements RequestHandlerInterface
{

    private array $middleware = [
        Authenticate::class,
        Success::class
    ];

    public function handle(Request $request): Response
    {
        if (empty($this->middleware)){
            return new Response('Server error',500);
        }

        $middlewareClass = array_shift($this->middleware);


        $response = (new $middlewareClass())->process($request,$this);

        return $response;
    }
}