<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MessageGenerator;

class JsonController extends AbstractController
{

    #[Route('/json', name: 'app_json', format: 'json', methods: ['GET'])]
    public function index(MessageGenerator $messageGenerator, LoggerInterface $logger): JsonResponse
    {
        $message = $messageGenerator->getHappyMessage();
        $myJsonString = $this->json(['username' => 'jane.doe', 'message' => $message]);
        $logger->error("MY JSON: ".$myJsonString);
        return $myJsonString;
    }
}
