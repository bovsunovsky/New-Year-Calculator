<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MainController extends AbstractController
{
    /**
     * @Route ("/main", methods={"GET"}, name="app_main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }
}
