<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\ManufacturerDto as ManufacturerDto;

interface ManufacturerProviderInterface
{
    public function getList();

    public function create(ManufacturerDto $dto): void;

    public function update(ManufacturerDto $dto, int $id): void;

    public function getById(int $id): ManufacturerDto;

    public function delete($id): void;
}
