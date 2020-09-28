<?php

declare(strict_types=1);

namespace App\Service;

interface CategoryProviderInterface
{
    public function getAll();

    public function create($category);

    public function update($category);
}
