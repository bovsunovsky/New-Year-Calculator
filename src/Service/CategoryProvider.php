<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryProvider implements CategoryProviderInterface
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->findAll();
    }
}
