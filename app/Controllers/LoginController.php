<?php

namespace App\Controllers;

use Framework\Authentication\SessionAuthInterface;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class LoginController extends AbstractController
{

    public function __construct(
        private SessionAuthInterface $sessionAuth
    )
    {
    }


    public function form(): Response
    {
        return $this->render('login.html.twig');
    }

    public function login()
    {
        $this->sessionAuth->authenticate(
                 $this->request->input('email'),
                 $this->request->input('password'),
        );
    }

}