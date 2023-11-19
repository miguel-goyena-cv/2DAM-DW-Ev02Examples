<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number')]
    public function number(LoggerInterface $logger): Response
    {
        $number = random_int(0, 100);
        $logger->info('We are logging!, my number is: '.$number);
        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}