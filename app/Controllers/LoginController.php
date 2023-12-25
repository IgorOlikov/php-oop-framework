<?php

namespace App\Controllers;

use Framework\Controller\AbstractController;
use Framework\Http\Response;

class LoginController extends AbstractController
{


    public function form(): Response
    {
        return $this->render('login.html.twig');
    }

    public function login()
    {
        dd($this->request);
    }

}