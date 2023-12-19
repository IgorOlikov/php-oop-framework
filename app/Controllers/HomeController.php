<?php

namespace App\Controllers;

use Framework\Http\Response;

class HomeController
{

    public function index(): Response
    {
        $content = 'HELLO WORLD';

        return new Response($content);
    }

}