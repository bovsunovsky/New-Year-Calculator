<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ManufacturerRepository;

class ManufacturerProvider implements ManufacturerProviderInterface
{
    private ManufacturerRepository $manufacturerRepository;

    public function __construct(ManufacturerRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }

    public function getList()
    {
        return $this->manufacturerRepository->findAll();
    }

    public function logicCreate($manufacturer)
    {
        $manufacturer->setCreatedAt(new \DateTimeImmutable());
        $manufacturer->setUpdatedAt(new \DateTimeImmutable());

        return $manufacturer;
    }

    public function logicUpdate($manufacturer)
    {
        $manufacturer->setUpdatedAt(new \DateTimeImmutable());

        return $manufacturer;
    }
}
