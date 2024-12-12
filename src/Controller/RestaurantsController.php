<?php

namespace App\Controller;

use App\Model\RestaurantDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\Response;

use App\Model\RestaurantNewDTO;
use App\Model\RestaurantTypeDTO;
use App\Services\RestaurantService;

class RestaurantsController extends AbstractController
{
    public function __construct(private RestaurantService $servicioRestaurantes){
    }

    #[Route('/restaurants', name: 'get_restaurants', methods: ['GET'])]
    public function getRestaurants(#[MapQueryParameter] string $tipo): JsonResponse
    {
        // Buscamos por el tipo
        if ($tipo == "Italiano") {
            return $this->json($this->servicioRestaurantes->getItalianRestaurant());
        } else {
            return $this->json($this->servicioRestaurantes->getAllRestaurants());
        }
    }

    #[Route('/restaurant-types', name: 'get_restaurant_types')]
    public function getRestaurantTypes(): JsonResponse
    {
        return $this->json($this->servicioRestaurantes->getAllRestaurtantTypes());
    }

    #[Route('/restaurant-types/{id}', name: 'get_restaurant_types_byid')]
    public function getRestaurantTypesById(int $id, LoggerInterface $logger): JsonResponse
    {
        $logger->info("Me  has pasado como parametro: " . $id);
        if ($id < sizeof($this->servicioRestaurantes->getAllRestaurtantTypes())) {
            return $this->json($this->servicioRestaurantes->getAllRestaurtantTypes()[$id]);
        } else {
            return $this->json(["error" => "No tengo el ID que me pides"], 400);
        }
    }

    #[Route('/restaurants', name: 'post_restaurants', methods: ['POST'])]
    public function newRestaurants(#[MapRequestPayload(validationFailedStatusCode: Response::HTTP_NOT_FOUND)] RestaurantNewDTO $restauranNewtDto): JsonResponse
    {
        // Inserto el objeto
        $nuevoRestaurante = new RestaurantDTO($restauranNewtDto->id, $restauranNewtDto->name, $this->servicioRestaurantes->getAllRestaurtantTypes()[$restauranNewtDto->resType]);
        $nuevoRestaurante = $this->servicioRestaurantes->createRestaurant($nuevoRestaurante);
        //Contesto
        return $this->json($nuevoRestaurante);
    }
}
