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

/**
 * @Route("/manufacturer")
 */
class ManufacturerController extends AbstractController
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
    public function create(Request $request): Response
    {
        $manufacturer = new Manufacturer();
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manufacturer = $this->manufacturerProvider->logicCreate($manufacturer);
            $em = $this->getDoctrine()->getManager();
            $em->persist($manufacturer);
            $em->flush();

            return $this->redirectToRoute('app_manufacturer');
        }

        return $this->render('manufacturer/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="app_update_manufacturer", methods={"GET", "POST"})
     */
    public function update(Request $request, Manufacturer $manufacturer): Response
    {
        $form = $this->createForm(ManufacturerType::class, $manufacturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manufacturerProvider->logicUpdate($manufacturer);
            $this->getDoctrine()->getManager()->flush();

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
    public function delete(Request $request, Manufacturer $manufacturer): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($manufacturer);
        $em->flush();

        return $this->redirectToRoute('app_manufacturer');
    }
}
