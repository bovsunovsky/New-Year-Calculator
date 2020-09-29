<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Service\CategoryProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/category")
 */
final class CategoryController extends AbstractController
{
    private CategoryProvider $categoryProvider;

    public function __construct(CategoryProvider $categoryProvider)
    {
        $this->categoryProvider = $categoryProvider;
    }

    /**
     * @Route("/index", name="app_category")
     */
    public function index(): Response
    {
        $categoryList = $this->categoryProvider->getAll();

        return $this->render('category/index.html.twig', [
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * @Route("/create" , name="app_create_category", methods={"GET","POST"})
     */
    public function create(Request $request, ValidatorInterface $validator): Response
    {
        $form = $this->createForm(CategoryType::class, null, [
            'action' => $this->generateUrl('app_create_category'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $form->getErrors();

            if (0 === count($errors)) {
                $this->categoryProvider->create($form->getData());
            } else {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="app_update_category", methods={"GET","POST"})
     */
    public function update(Request $request, int $id): Response
    {
        $category = $this->categoryProvider->getById($id);
        $form = $this->createForm(CategoryType::class, $category, [
            'action' => $this->generateUrl('app_update_category', ['id' => $id]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $form->getErrors();

            if (0 === count($errors)) {
                $this->categoryProvider->update($form->getData(), $id);
            } else {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/update.html.twig', [
           'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_category_delete", methods={"GET"})
     */
    public function delete(Request $request, int $id): Response
    {
        $this->categoryProvider->delete($id);

        return $this->redirectToRoute('app_category');
    }
}
