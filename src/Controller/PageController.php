<?php

namespace App\Controller;

use App\Repository\JuegoNDSRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

final class PageController extends AbstractController
{
    #[Route('/page', name: 'app_page')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PageController.php',
        ]);
    }
    #[Route('/', name: 'inicio')]
    public function inicio(ManagerRegistry $doctrine): Response
    {
        $repositorio = $doctrine->getRepository(JuegoNDSRepository::class);
        $juego = $repositorio->findAll();

        //Mostramos la plantilla pasándole los juegos como variable
        return $this->render("inicio.html.twig", ["juegos" => $juego]);
    }
}