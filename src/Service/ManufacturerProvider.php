<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\ManufacturerDto as ManufacturerDto;
use App\Entity\Manufacturer;
use App\Repository\ManufacturerRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;

class ManufacturerProvider implements ManufacturerProviderInterface
{
    private ManufacturerRepository $manufacturerRepository;
    private EntityManagerInterface $em;

    public function __construct(ManufacturerRepository $manufacturerRepository, EntityManagerInterface $em)
    {
        $this->manufacturerRepository = $manufacturerRepository;
        $this->em = $em;
    }

    public function getList()
    {
        return $this->manufacturerRepository->findAll();
    }

    public function create(ManufacturerDto $dto): void
    {
        $manufacturer = new Manufacturer($dto);
        $manufacturer->setCreatedAt(new \DateTimeImmutable());
        $manufacturer->setUpdatedAt(new \DateTimeImmutable());
        try {
            $this->em->persist($manufacturer);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
        }
    }

    public function update(ManufacturerDto $dto, int $id): void
    {
        $manufacturer = $this->manufacturerRepository->find($id);
        $manufacturer->setName($dto->getName());
        $manufacturer->setUpdatedAt(new \DateTimeImmutable());
        $this->em->flush();
    }

    public function getById(int $id): ManufacturerDto
    {
        $manufacturer = $this->manufacturerRepository->find($id);
        return new ManufacturerDto($manufacturer->getName());
    }

    public function delete($id): void
    {
        $manufacturer = $this->manufacturerRepository->find($id);
        $this->em->remove($manufacturer);
        $this->em->flush();
    }
}
