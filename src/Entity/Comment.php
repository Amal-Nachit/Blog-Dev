<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private $text;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?User $userComment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getUserComment(): ?User
    {
        return $this->userComment;
    }

    public function setUserComment(?User $userComment): static
    {
        $this->userComment = $userComment;

        return $this;
    }
}
