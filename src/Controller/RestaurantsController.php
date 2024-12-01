<?php

namespace App\Controller;

use App\Model\RestauranteNewDTO;
use App\Service\RestaurantsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Psr\Log\LoggerInterface;


class RestaurantsController extends AbstractController
{

    public function __construct(private LoggerInterface $logger, private RestaurantsService $restaurantsService)
    {}

    #[Route('/restaurants', name: 'get_restaurants', methods:['GET'])]
    public function getRestaurants(#[MapQueryParameter] string $tipo): JsonResponse
    {
        $this->logger->info("Quiero los restaurantes del tipo: ".$tipo);
        // Buscamos por el tipo
        if ($tipo == "Italiano"){
            return $this->json($this->restaurantsService->getItalianRestaurants());
        }
        else{
            return $this->json($this->restaurantsService->getAllRestaurants());
        }
        
    }

    // #[Route('/restaurants', name: 'post_restaurants', methods:['POST'])]
    // public function newRestaurants(Request $request): JsonResponse
    // {
    //     // Recuperamos del request el Body
    //     $jsonBody = $request->getContent(); // Obtiene el cuerpo como texto
    //     $data = json_decode($jsonBody, true); // Lo decodifica a un array asociativo

    //     // Manejo de errores si el JSON no es válido
    //     if (json_last_error() !== JSON_ERROR_NONE) {
    //         return $this->json(['error' => 'JSON inválido'], 400);
    //     }

    //     // Inserto el objeto
    //     array_push($this->restaurantes, $data);

    //     //Contesto
    //     return $this->json($this->restaurantes[sizeof($this->restaurantes)-1]);
        
    // }

    #[Route('/restaurants', name: 'post_restaurants', methods:['POST'], format: 'json')]
    public function newRestaurants(#[MapRequestPayload(
        acceptFormat: 'json',
        validationFailedStatusCode: Response::HTTP_NOT_FOUND
    )] RestauranteNewDTO $restauranNewtDto): JsonResponse
    {
        // Inserto el objeto
        $this->restaurantsService->addRestaurant($restauranNewtDto);

        //Contesto
        return $this->json($restauranNewtDto);
        
    }

    #[Route('/restaurants/{id}', name: 'get_restaurants_by_id')]
    public function getRestaurantsById(string $id): JsonResponse
    {
        if ($this->restaurantsService->existRestaurantById($id)){
            return $this->json($this->restaurantsService->getRestaurantsById($id));
        }
        else{
            return $this->json(["error" => "No tengo el ID que me pides"], 400);
        }
    }

    #[Route('/restaurant-types', name: 'get_restaurant_types')]
    public function getRestaurantTypes(): JsonResponse
    {
        return $this->json($this->restaurantsService->getRestaurantTypes());
    }
}
