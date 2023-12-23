<?php

namespace App\Entities;

class Post
{


    public function __construct(
           private ?int $id = null,
           private string $title,
           private string $body,
           private \DateTimeImmutable|null $createdAt,
       )
       {
       }

       public static function create(
            string $title,
            string $body,
            ?int $id = null,
            \DateTimeImmutable|null $createdAt = null
       ): static {
           return new static($id,$title,$body,$createdAt);
       }


}