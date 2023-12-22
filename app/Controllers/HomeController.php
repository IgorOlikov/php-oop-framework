<?php

namespace App\Controllers;

use Framework\Controller\AbstractController;
use Framework\Http\Response;


class HomeController extends AbstractController
{
    public function __construct()
    {

    }


    public function index(): Response
    {
        $content = 'HELLO WORLD';
        $param = [
            'param' => 'https://google.com'
        ];



        return $this->render('home.html.twig',['https://google.com']);
    }

}