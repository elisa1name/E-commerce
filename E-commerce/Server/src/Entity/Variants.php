<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VariantsRepository")
 */
class Variants
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Memory_size;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Screen_size;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Weight_of_article;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Operating_system;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="variants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getMemorySize(): ?string
    {
        return $this->Memory_size;
    }

    public function setMemorySize(?string $Memory_size): self
    {
        $this->Memory_size = $Memory_size;

        return $this;
    }

    public function getScreenSize(): ?string
    {
        return $this->Screen_size;
    }

    public function setScreenSize(?string $Screen_size): self
    {
        $this->Screen_size = $Screen_size;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getWeightOfArticle(): ?int
    {
        return $this->Weight_of_article;
    }

    public function setWeightOfArticle(?int $Weight_of_article): self
    {
        $this->Weight_of_article = $Weight_of_article;

        return $this;
    }

    public function getOperatingSystem(): ?string
    {
        return $this->Operating_system;
    }

    public function setOperatingSystem(?string $Operating_system): self
    {
        $this->Operating_system = $Operating_system;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
}
