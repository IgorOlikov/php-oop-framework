<?php

namespace App\Services;

use App\Entities\Post;
use Doctrine\DBAL\Connection;

class PostService
{
    public function __construct(
        private Connection $connection
    )
    {
    }

    public function save(Post $post)
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $queryBuilder
            ->insert('posts')
            ->values([
                'title' => ':title',
                'body' => ':body',
                'created_at' => ':created_at'
            ])
            ->setParameters([
                'title' => $post->getTitle(),
                'body' => $post->getBody(),
                'created_at' => $post->getCreatedAt()->format('Y-m-d H:i:s'),
            ])->executeQuery();

        $id = $this->connection->lastInsertId();

        $post->setId($id);

        return $post;

    }

    public function find($id): ?Post
    {
        $queryBuilder = $this->connection->createQueryBuilder();

        $result = $queryBuilder
            ->select('*')
            ->from('posts')
            ->where('id = :id')
            ->setParameter('id', $id)
            ->executeQuery();

        $post = $result->fetchAllAssociative();
        if (!$post){
            return null;
        }
        //dd($post[0]);

        $post = $post[0];


        return Post::create(
            title: $post['title'],
            body: $post['body'],
            id: $post['id'],
            createdAt: new \DateTimeImmutable($post['created_at']),
        );


    }

}