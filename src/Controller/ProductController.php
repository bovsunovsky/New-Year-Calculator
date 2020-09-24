<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\ProductProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
final class ProductController extends AbstractController
{
    private ProductProviderInterface $productProvider;

    public function __construct(ProductProviderInterface $productProvider)
    {
        $this->productProvider = $productProvider;
    }

    /**
     * @Route("/index", name="app_product")
     */
    public function index(): Response
    {
        $productList = $this->productProvider->getAll();

        return $this->render('product/index.html.twig', [
            'productList' => $productList,
        ]);
    }

    /**
     * @Route("/create", name="app_product_new", methods={"GET","POST"})
     */
    public function create(Request $request): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            $imageDirectory = $this->getParameter('images_directory');
            $product = $this->productProvider->logicCreate($product, $imageFile, $imageDirectory);
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="app_product_update", methods={"GET","POST"})
     */
    public function update(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            $imageDirectory = $this->getParameter('images_directory');
            $this->productProvider->logicUpdate($product, $imageFile, $imageDirectory);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_product');
        }

        return $this->render('product/update.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_product_delete", methods={"GET"})
     */
    public function delete(Request $request, Product $product): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('app_product');
    }

    /**
     * @Route("/category/{categoryId}", name="app_products_by_category")
     */
    public function productByCategory($categoryId): Response
    {
        $productListByCategory = $this->productProvider->getAllByCategory($categoryId);

        return $this->render('product/indexByCategory.html.twig', [
            'productListByCategory' => $productListByCategory,
        ]);
    }

    /**
     * @Route("/manufacture/{manufacturerId}", name="app_products_by_manufacturer")
     */
    public function productByManufacturer($manufacturerId): Response
    {
        $productListByManufacturer = $this->productProvider->getAllByManufacturer($manufacturerId);

        return $this->render('product/indexByManufacturer.html.twig', [
            'productListByManufacturer' => $productListByManufacturer,
        ]);
    }
}
