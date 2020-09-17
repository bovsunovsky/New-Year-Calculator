<?php

declare(strict_types=1);

namespace App\ViewModel;

final class Product
{
    private int $id;
    private string $title;
    private ?string $shortDescription;
    private string $image;
    private float $price;
    private float $weight;
    private int $status;
    private string $mainCategory;
    private string $manufacturer;
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;

    public function __construct(
    int $id,
    string $title,
    ?string $shortDescription,
    string $image,
    float $price,
    float $weight,
    int $status,
    string $mainCategory,
    string $manufacturer,
    \DateTimeImmutable $createdAt,
    \DateTimeImmutable $updatedAt
    ) {


        $this->id = $id;
        $this->title = $title;
        $this->shortDescription = $shortDescription;
        $this->image = $image;
        $this->price = $price;
        $this->weight = $weight;
        $this->status = $status;
        $this->mainCategory = $mainCategory;
        $this->manufacturer = $manufacturer;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getMainCategory(): string
    {
        return $this->mainCategory;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }


}
