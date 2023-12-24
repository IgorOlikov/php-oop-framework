<?php

namespace Framework\Http\Middleware;

use Framework\Http\Request;
use Framework\Http\Response;

class Success implements MiddlewareInterface
{

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        return new Response('hello,world');
    }
}