<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class ManufacturerDto
{
    private int $id;

    /**
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private string $name;
    private \DateTimeImmutable $createdAt;
    private \DateTimeImmutable $updatedAt;
    private $products;

    public function __construct(string $name)
    {

        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getProducts()
    {
        return $this->products;
    }
}
