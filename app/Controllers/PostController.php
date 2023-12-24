<?php

namespace App\Controllers;
use App\Entities\Post;
use App\Services\PostService;
use Framework\Controller\AbstractController;
use Framework\Http\RedirectResponse;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Session\SessionInterface;

class PostController extends AbstractController
{

    public function __construct(
        private PostService $service,
        private SessionInterface $session
    )
    {
    }

    public function show(int $id): Response
    {
         $post = $this->service->findOrFail($id);

        return $this->render('posts.html.twig',[
            'post' => $post
        ]);

    }

    public function create(): Response
    {
        return $this->render('create_post.html.twig');
    }
    public function store()
    {
        $post = Post::create(
            $this->request->postData['title'],
            $this->request->postData['body']
        );
        $post = $this->service->save($post);

        $this->request->getSession()->setFlash('success','post created');

        return new RedirectResponse("/posts/{$post->getId()}");
    }

}