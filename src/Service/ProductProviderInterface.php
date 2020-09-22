<?php

declare(strict_types=1);

namespace App\Service;

interface ProductProviderInterface
{
    public function getList();

    public function getForSlider();

    public function getAll();

    public function logicCreate($product, $imageFile, $imageDirectory);

    public function logicUpdate($product, $imageFile, $imageDirectory);

    public function getAllByCategory($categoryId);

    public function getAllByManufacturer($manufacturerId);
}
