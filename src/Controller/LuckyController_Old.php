<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController_Old
{
    #[Route('/lucky/number_old')]
    public function number(): Response
    {
        $number = random_int(0, 100);
        //$logger->info('We are logging!, my number is: '.$number);
        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }
}