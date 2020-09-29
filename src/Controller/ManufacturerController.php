<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Manufacturer;
use App\Form\ManufacturerType;
use App\Service\ManufacturerProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/manufacturer")
 */
final class ManufacturerController extends AbstractController
{
    private ManufacturerProvider $manufacturerProvider;

    public function __construct(ManufacturerProvider $manufacturerProvider)
    {
        $this->manufacturerProvider = $manufacturerProvider;
    }

    /**
     * @Route("/index", name="app_manufacturer")
     */
    public function index(): Response
    {
        $manufacturerList = $this->manufacturerProvider->getList();

        return $this->render('manufacturer/index.html.twig', [
            'manufacturerList' => $manufacturerList,
        ]);
    }

    /**
     * @Route("/create", name="app_create_manufacturer", methods={"GET", "POST"})
     */
    public function create(Request $request, ValidatorInterface $validator): Response
    {
        $form = $this->createForm(ManufacturerType::class, null, [
            'action' => $this->generateUrl('app_create_manufacturer'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $form->getErrors();

            if (0 === count($errors)) {
                $this->manufacturerProvider->create($form->getData());
            } else {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

            return $this->redirectToRoute('app_manufacturer');
        }

        return $this->render('manufacturer/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="app_update_manufacturer", methods={"GET", "POST"})
     */
    public function update(Request $request, int $id): Response
    {
        $manufacturer = $this->manufacturerProvider->getById($id);
        $form = $this->createForm(ManufacturerType::class, $manufacturer, [
            'action' => $this->generateUrl('app_update_manufacturer', ['id' => $id]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $errors = $form->getErrors();

            if (0 === count($errors)) {
                $this->manufacturerProvider->update($form->getData(), $id);
            } else {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }

            return $this->redirectToRoute('app_manufacturer');
        }

        return $this->render('manufacturer/update.html.twig', [
            'form' => $form->createView(),
            'manufacturer' => $manufacturer,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_delete_manufacturer", methods={"GET"})
     */
    public function delete(Request $request, int $id): Response
    {
        $this->manufacturerProvider->delete($id);

        return $this->redirectToRoute('app_manufacturer');
    }
}
