<?php

declare(strict_types=1);

namespace App\Service;

use App\ViewModel\Product;
use Faker\Factory;
use Faker\Generator;

class ProductFakeProvider implements ProductProviderInterface
{
    private const COUNT_PRODUCTS = 15;
    private const CATEGORIES = [
        'World',
        'Science',
        'IT',
        'Something',
    ];
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function getList()
    {
        $products = [];

        for ($i = 0; $i <= self::COUNT_PRODUCTS; ++$i) {
            $products[] = $this->createProduct($i + 1);
        }

        return $products;
    }

    public function getForSlider()
    {
        $productsForSlider = [];

        for ($i = 0; $i <= 2; ++$i) {
            $productsForSlider[] = $this->createProduct($i + 1);
        }

        return $productsForSlider;
    }

    public function createProduct(int $id): Product
    {
        return new Product(
            $id,
            $this->faker->words(3, true),
            $this->faker->words(7, true),
            $this->faker->imageUrl(),
            $this->faker->randomFloat(),
            $this->faker->randomFloat(),
            $this->faker->numberBetween(0,1),
            $this->faker->randomElement(self::CATEGORIES),
            $this->faker->company,
            \DateTimeImmutable::createFromMutable($this->faker->dateTime),
            \DateTimeImmutable::createFromMutable($this->faker->dateTime),
        );
    }
}
