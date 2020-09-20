<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Service\ProductProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//use App\Service\FileUploader;

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
     * @Route("/{id}", name="app_product_update", methods={"GET","POST"})
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
     * @Route("/product/{id}", name="product_delete", methods={"GET"})
     */
    public function delete(Request $request, Product $product): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('app_product');
    }
}
