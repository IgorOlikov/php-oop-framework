<?php

namespace Framework\Http\Middleware;

use Framework\Authentication\SessionAuthInterface;
use Framework\Http\RedirectResponse;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Session\SessionInterface;

class Guest implements MiddlewareInterface
{

    public function __construct(
        private SessionAuthInterface $auth,
        private SessionInterface $session
    )
    {
    }

    public function process(Request $request, RequestHandlerInterface $handler): Response
    {
        $this->session->start();

        if ($this->auth->check()){
            return  new RedirectResponse('/dashboard');
        }

        return $handler->handle($request);
    }
}