<?php

declare(strict_types=1);

namespace App\Service;

interface CategoryProviderInterface
{
    public function getAll();

    public function logicCreate($category);

    public function logicUpdate($category);
}
