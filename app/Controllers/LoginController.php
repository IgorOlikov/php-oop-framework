<?php

namespace App\Controllers;

use Framework\Authentication\SessionAuthInterface;
use Framework\Controller\AbstractController;
use Framework\Http\RedirectResponse;
use Framework\Http\Response;

class LoginController extends AbstractController
{

    public function __construct(
        private readonly SessionAuthInterface $auth
    )
    {
    }


    public function form(): Response
    {
        return $this->render('login.html.twig');
    }

    public function login(): RedirectResponse
    {
       $isAuth = $this->auth->authenticate(
                 $this->request->input('email'),
                 $this->request->input('password'),
        );

       if (! $isAuth){
           $this->request->getSession()->setFlash('error','incorrect login or password');

          return new RedirectResponse('/login');
       }

       $this->request->getSession()->setFlash('success','login success');

       return new RedirectResponse('/dashboard');
    }

    public function logout(): RedirectResponse
    {
        $this->auth->logout();

        return new RedirectResponse('/');
    }


}