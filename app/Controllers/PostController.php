<?php

namespace App\Controllers;
use App\Entities\Post;
use Framework\Controller\AbstractController;
use Framework\Http\Request;
use Framework\Http\Response;
class PostController extends AbstractController
{

    public function show(int $id): Response
    {

        return $this->render('posts.html.twig',[
            'postId' => $id
        ]);

    }

    public function create(): Response
    {
        return $this->render('create_post.html.twig');
    }
    public function store()
    {
        $post =  Post::create(
            $this->request->postData['title'],
            $this->request->postData['body']
        );
        dd($post);
        //dd($this->request->postData);
    }

}