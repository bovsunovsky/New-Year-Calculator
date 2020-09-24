<?php

declare(strict_types=1);

namespace App\Service;

interface ManufacturerProviderInterface
{
    public function getList();

    public function logicCreate($manufacturer);

    public function logicUpdate($manufacturer);
}
