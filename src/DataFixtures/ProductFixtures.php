<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;

final class ProductFixtures extends AbstractFixture
{
    private const COUNT_PRODUCTS = 15;
    private const CATEGORIES = [
        'World',
        'Science',
        'IT',
        'Something',
    ];

    public function createProduct(): Product
    {
        $product = new Product(
            $this->faker->words(3, true),
            $this->faker->imageUrl(),
            $this->faker->randomFloat(),
            $this->faker->randomFloat(),
            $this->faker->randomElement(self::CATEGORIES),
            $this->faker->words(3, true),
        );

        return $product;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i <= self::COUNT_PRODUCTS; ++$i) {
            $product = $this->createProduct();
            $manager->persist($product);
        }
        $manager->flush();
    }
}
