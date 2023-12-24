<?php

namespace App\Controllers;

use App\Forms\User\RegisterForm;
use App\Services\UserService;
use Framework\Controller\AbstractController;
use Framework\Http\RedirectResponse;
use Framework\Http\Response;

class RegisterController extends AbstractController
{

        public function __construct(
            private UserService $userService
        )
        {
        }


    public function form() : Response
        {
            return $this->render('register.html.twig');
        }

        public function register(): RedirectResponse
        {
            $form = new RegisterForm($this->userService); // user service missing

            $form->setFields(
                $this->request->input('email',),
                $this->request->input('password',),
                $this->request->input('password_confirmation',),
                $this->request->input('name'),
            );

            if ($form->hasValidationErrors()) {
                foreach ($form->getValidationErrors() as $error){
                    $this->request->getSession()->setFlash('error',$error);
                }
                return new RedirectResponse('/register');
            }
            $user = $form->save();

            $this->request->getSession()->setFlash('success',"User {$user->getEmail()} has been registred");

            return new RedirectResponse('/register');
        }



}