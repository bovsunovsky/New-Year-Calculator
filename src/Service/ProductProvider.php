<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Exception\BadImageException;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProductProvider implements ProductProviderInterface
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->findAll();
    }

    public function create($product, $imageFile, $imageDirectory): Product
    {
        $this->imageSaver($imageFile, $product, $imageDirectory);
        $product->setCreatedAt(new \DateTimeImmutable());
        $product->setUpdatedAt(new \DateTimeImmutable());

        return $product;
    }

    public function update($product, $imageFile, $imageDirectory): Product
    {
        $this->imageSaver($imageFile, $product, $imageDirectory);
        $product->setUpdatedAt(new \DateTimeImmutable());

        return $product;
    }

    private function imageSaver($imageFile, $product, $imageDirectory): void
    {
        if (null === $imageFile) {
            if ('' === $product->getImage()) {
                $product->setImage('default.png');
            }
        } else {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            try {
                $imageFile->move(
                    $imageDirectory,
                    $newFilename
                );
            } catch (FileException $e) {
                throw new BadImageException();
            }
            $product->setImage($newFilename);
        }
    }

    public function getAllByCategory($categoryId)
    {
        return $this->productRepository->findBy(['category' => $categoryId]);
    }

    public function getAllByManufacturer($manufacturerId)
    {
        return $this->productRepository->findBy(['manufacture' => $manufacturerId]);
    }
}
