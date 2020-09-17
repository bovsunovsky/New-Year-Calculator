<?php

declare(strict_types=1);

namespace App\Service;

interface ProductProviderInterface
{
    public function getList();
    public function getForSlider();
}
