<?php

namespace App\Entities;

use Framework\Authentication\AuthUserInterface;
use Framework\Dbal\Entity;

class User extends Entity implements AuthUserInterface
{

    public function __construct(
        private ?int $id,
        private ?string $name,
        private string $email,
        private string $password,
        private \DateTimeImmutable $createdAt
    )
    {
    }



    public static function create(string $email,string $password,\DateTimeImmutable $createdAt = null,string $name = null,int $id = null): static
    {
        return new static($id, $name, $email, $password, $createdAt ?? new \DateTimeImmutable());
    }
    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }


}