<?php

namespace App\Services;

use App\Model\RestaurantNewDTO;
use App\Model\RestaurantTypeDTO;
use App\Model\RestaurantDTO;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantService
{
    private $restaurantes;
    private $restaurantesItalianos;
    private $restaurant_types;

    public function __construct(private EntityManagerInterface $entityManager){

        // Relleno la información de la BBDD
        $restaurantType1 = new RestaurantTypeDTO(1,"Oriental");
        $restaurantType2 = new RestaurantTypeDTO(2,"Italiano");
        $restaurante1 = new RestaurantDTO(10,"La Taggliatella",$restaurantType1);
        $restaurante2 = new RestaurantDTO(11,"Ñam Sarasate",$restaurantType2);
        $this->restaurantes = [$restaurante1, $restaurante2];
        $this->restaurantesItalianos = [$restaurante2];
        $this->restaurant_types = [$restaurantType1, $restaurantType2];

    }

    public function getItalianRestaurant(): array{
        return $this->restaurantesItalianos;
    }

    public function getAllRestaurants(): array{
        return $this->entityManager->getRepository(Restaurant::class)->findAll();
        // return $this->restaurantes;
    }

    public function getAllRestaurtantTypes(): array{
        return $this->restaurant_types;
    }

    public function createRestaurant(RestaurantDTO $nuevoRestaurante) : RestaurantDTO{
        array_push($this->restaurantes, $nuevoRestaurante);
        return $nuevoRestaurante;
    }
       
}