<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ProductProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProductController extends AbstractController
{
    private ProductProviderInterface $productProvider;

    public function __construct(ProductProviderInterface $productProvider)
    {
        $this->productProvider = $productProvider;
    }

    /**
     * @Route("/", name="app_product")
     */
    public function index(): Response
    {
        $products = $this->productProvider->getList();
        $productsForSlider = $this->productProvider->getForSlider();


        return $this->render('product/index.html.twig', [
            'products' => $products,
            'productsForSlider' => $productsForSlider
        ]);
    }
}
