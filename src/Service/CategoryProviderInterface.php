<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CategoryDto;

interface CategoryProviderInterface
{
    public function getAll();

    public function create(CategoryDto $dto): void;

    public function update(CategoryDto $dto, int $id): void;

    public function getById(int $id): CategoryDto;

    public function delete($id): void;
}
