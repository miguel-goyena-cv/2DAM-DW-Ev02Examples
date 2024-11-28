<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Psr\Log\LoggerInterface;

class RestaurantsController extends AbstractController
{

    private $restaurantes = [
        [
            "id" => 10,
            "name" => "La Taggliatella",
            "rest-type" => [
                "id" => 1,
                "name" => "Oriental"
            ]
        ],
        [
            "id" => 11,
            "name" => "Ñam Sarasate",
            "rest-type" => [
                "id" => 2,
                "name" => "Italiano"
            ]
        ]
    ];

    private $restaurantesItalianos = [
        [
            "id" => 11,
            "name" => "Ñam Sarasate",
            "rest-type" => [
                "id" => 2,
                "name" => "Italiano"
            ]
        ]
    ];

    private $restaurant_types = [
        [
            "id" => 1,
            "name" => "Oriental"
        ],
        [
            "id" => 2,
            "name" => "Italiano"
        ]
    ];

    #[Route('/restaurants', name: 'get_restaurants')]
    public function getRestaurants(#[MapQueryParameter] string $tipo): JsonResponse
    {
        // Buscamos por el tipo
        if ($tipo == "Italiano"){
            return $this->json($this->restaurantesItalianos);
        }
        else{
            return $this->json($this->restaurantes);
        }
        
    }

    #[Route('/restaurant-types', name: 'get_restaurant_types')]
    public function getRestaurantTypes(): JsonResponse
    {
        return $this->json($this->restaurant_types);
    }

    #[Route('/restaurant-types/{id}', name: 'get_restaurant_types_byid')]
    public function getRestaurantTypesById(int $id, LoggerInterface $logger): JsonResponse
    {
        $logger->info("Me  has pasado como parametro: ".$id);
        if ($id < sizeof($this->restaurant_types)){
            return $this->json($this->restaurant_types[$id]);
        }
        else{
            return $this->json(["error" => "No tengo el ID que me pides"], 400);
        }
   
    }
}
