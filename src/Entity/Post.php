<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\Table(name: '`posts`')]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(length: 180, unique: false)]
    private ?string $title = null;

    #[ORM\Column(type: 'text', unique: false)]
    private ?string $body = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(string $data): self
    {
        $this->user_id = $data;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $data): self
    {
        $this->title = $data;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $data): self
    {
        $this->body = $data;

        return $this;
    }

    public function asArray()
    {
        return array(
            'id' => $this->id
            ,'user_id' => $this->user_id
            ,'title' => $this->title
            ,'body' => $this->body
        );
    }
}
