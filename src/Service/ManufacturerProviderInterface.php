<?php

declare(strict_types=1);

namespace App\Service;

interface ManufacturerProviderInterface
{
    public function getList();

    public function create($manufacturer);

    public function update($manufacturer);
}
