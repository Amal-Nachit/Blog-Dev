<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Article>
     */
    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'articleCategorie')]
    private Collection $categorieArticle;

    public function __construct()
    {
        $this->categorieArticle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getCategorieArticle(): Collection
    {
        return $this->categorieArticle;
    }

    public function addCategorieArticle(Article $categorieArticle): static
    {
        if (!$this->categorieArticle->contains($categorieArticle)) {
            $this->categorieArticle->add($categorieArticle);
        }

        return $this;
    }

    public function removeCategorieArticle(Article $categorieArticle): static
    {
        $this->categorieArticle->removeElement($categorieArticle);

        return $this;
    }
}
