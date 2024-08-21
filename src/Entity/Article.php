<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups as AnnotationGroups;
use Symfony\Component\Serializer\Attribute\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[Vich\Uploadable]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_article_liste'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_article_liste'], ['api_article_show'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_article_liste'], ['api_article_show'])]
    private ?string $image = null;

    #[ORM\Column(type: Types::BLOB)]
    #[Groups(['api_article_liste'], ['api_article_show'])]
    private $text;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['api_article_liste'], ['api_article_show'])]
    private ?user $creator = null;

    #[Vich\UploadableField(mapping: 'thumbnail', fileNameProperty: 'image')]
    #[Assert\Image()]
    private ?File $thumbnailFile = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'categorieArticle')]
    // #[Groups(['api_article_liste'], ['api_article_show'])]
    private Collection $articleCategorie;

    public function __construct()
    {
        $this->articleCategorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
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

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreator(): ?user
    {
        return $this->creator;
    }

    public function setCreator(?user $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get the value of thumbnailFile
     */
    public function getThumbnailFile(): ?File
    {
        return $this->thumbnailFile;
    }

    /**
     * Set the value of thumbnailFile
     */
    public function setThumbnailFile(?File $thumbnailFile): static
    {
        $this->thumbnailFile = $thumbnailFile;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getArticleCategorie(): Collection
    {
        return $this->articleCategorie;
    }

    public function addArticleCategorie(Categorie $articleCategorie): static
    {
        if (!$this->articleCategorie->contains($articleCategorie)) {
            $this->articleCategorie->add($articleCategorie);
            $articleCategorie->addCategorieArticle($this);
        }

        return $this;
    }

    public function removeArticleCategorie(Categorie $articleCategorie): static
    {
        if ($this->articleCategorie->removeElement($articleCategorie)) {
            $articleCategorie->removeCategorieArticle($this);
        }

        return $this;
    }

}
