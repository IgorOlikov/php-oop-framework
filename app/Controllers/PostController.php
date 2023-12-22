<?php

namespace App\Controllers;
use Framework\Controller\AbstractController;
use Framework\Http\Response;
class PostController extends AbstractController
{

    public function show(int $id)
    {

        return $this->render('posts.html.twig',[
            'postId' => $id
        ]);

    }

}