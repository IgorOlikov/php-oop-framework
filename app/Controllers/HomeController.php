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
        dd($this->container->get('twig'));

        $content = 'HELLO WORLD';

        return new Response($content);
    }

}