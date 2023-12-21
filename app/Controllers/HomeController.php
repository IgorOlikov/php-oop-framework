<?php

namespace App\Controllers;

use Framework\Http\Response;
use Twig\Environment;

class HomeController
{
    public function __construct(
        private readonly Environment $twig
    )
    {

    }


    public function index(): Response
    {
        dd($this->twig);

        $content = 'HELLO WORLD';

        return new Response($content);
    }

}