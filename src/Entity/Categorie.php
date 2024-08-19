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
    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'categorie')]
    private Collection $articleToCategorie;

    public function __construct()
    {
        $this->articleToCategorie = new ArrayCollection();
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
    public function getArticleToCategorie(): Collection
    {
        return $this->articleToCategorie;
    }

    public function addArticleToCategorie(Article $articleToCategorie): static
    {
        if (!$this->articleToCategorie->contains($articleToCategorie)) {
            $this->articleToCategorie->add($articleToCategorie);
            $articleToCategorie->addCategorie($this);
        }

        return $this;
    }

    public function removeArticleToCategorie(Article $articleToCategorie): static
    {
        if ($this->articleToCategorie->removeElement($articleToCategorie)) {
            $articleToCategorie->removeCategorie($this);
        }

        return $this;
    }
}
