<?php

declare(strict_types=1);

namespace App\Service;

interface ProductProviderInterface
{
    public function getAll();

    public function create($product, $imageFile, $imageDirectory);

    public function update($product, $imageFile, $imageDirectory);

    public function getAllByCategory($categoryId);

    public function getAllByManufacturer($manufacturerId);
}
