<?php

namespace App\Controllers;

use App\Forms\User\RegisterForm;
use Framework\Controller\AbstractController;
use Framework\Http\Response;

class RegisterController extends AbstractController
{
        public function form() : Response
        {
            return $this->render('register.html.twig');
        }

        public function register()
        {
            $form = new RegisterForm(); // user service missing

            $form->setFields(
                $this->request->input('email',),
                $this->request->input('password',),
                $this->request->input('password_confirmation',),
                $this->request->input('name'),
            );

            dd($form);
        }



}