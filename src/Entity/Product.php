<?php

namespace App\Entity;

use App\Exception\ProductShortDescriptionCannotBeEmptyException;
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
    private string $title;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private ?string $shortDescription = null;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private string $image;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * @ORM\Column(type="float")
     */
    private float $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $status = 0;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $mainCategory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $manufacturer;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $updatedAt;

    public function __construct(string $title, string $image, float $price, float $weight, string $mainCategory, string $manufacturer, \DateTimeImmutable $createdAt, \DateTimeImmutable $updatedAt)
    {
        $this->title = $title;
        $this->image = $image;
        $this->price = $price;
        $this->weight = $weight;
        $this->mainCategory = $mainCategory;
        $this->manufacturer = $manufacturer;
        $this->createdAt = $this->updatedAt = new \DateTimeImmutable();
    }

    public function addShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function setStatus(?int $status): self
    {
        if (null === $this->shortDescription) {
            throw new ProductShortDescriptionCannotBeEmptyException();
        }
        $this->status = $status;

        return $this;
    }
}
