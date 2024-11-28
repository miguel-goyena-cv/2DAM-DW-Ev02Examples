<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HolaClaseController extends AbstractController
{
    #[Route('/hola/{clase}', name: 'app_hola_clase')]
    public function index($clase=""): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!'.$clase,
            'path' => 'src/Controller/HolaClaseController.php',
        ]);
    }
}
