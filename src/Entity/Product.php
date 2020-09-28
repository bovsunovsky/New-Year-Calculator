<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private ?string $shortDescription = null;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private ?string $image = '';

    /**
     * @ORM\Column(type="integer")
     */
    private int $price;

    /**
     * @ORM\Column(type="integer")
     */
    private int $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private int $status = 0;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=Manufacturer::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manufacture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Product
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): Product
    {
        $this->title = $title;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): Product
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): Product
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Product
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): Product
    {
        $this->weight = $weight;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): Product
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): Product
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): Product
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

//    public function __construct(string $title, string $image, float $price, float $weight, string $mainCategory, string $manufacturer)
//    {
//        $this->title = $title;
//        $this->image = $image;
//        $this->price = $price;
//        $this->weight = $weight;
//        $this->mainCategory = $mainCategory;
//        $this->manufacturer = $manufacturer;
//        $this->createdAt = new \DateTimeImmutable();
//        $this->updatedAt = $this->createdAt;
//    }

    // проекция сущности
//    public function getProduct(): \App\ViewModel\Product
//    {
//        return new \App\ViewModel\Product(
//            $this->id,
//            $this->title,
//            $this->shortDescription,
//            $this->image,
//            $this->price,
//            $this->weight,
//            $this->status,
//            'Set Category here',
//            $this->manufacturer,
//            $this->createdAt,
//            $this->updatedAt,
//        );
//    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getManufacture(): ?Manufacturer
    {
        return $this->manufacture;
    }

    public function setManufacture(?Manufacturer $manufacture): self
    {
        $this->manufacture = $manufacture;

        return $this;
    }
}
