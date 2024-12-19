<?php

namespace App\Services;

use App\Model\RestaurantNewDTO;
use App\Model\RestaurantTypeDTO;
use App\Model\RestaurantDTO;
use App\Entity\Restaurant;
use App\Entity\RestaurantType;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantService
{
    private $restaurantes;
    private $restaurantesItalianos;
    private $restaurant_types;

    public function __construct(private EntityManagerInterface $entityManager)
    {

        // Relleno la información de la BBDD
        $restaurantType1 = new RestaurantTypeDTO(1, "Oriental");
        $restaurantType2 = new RestaurantTypeDTO(2, "Italiano");
        $restaurante1 = new RestaurantDTO(10, "La Taggliatella", $restaurantType1);
        $restaurante2 = new RestaurantDTO(11, "Ñam Sarasate", $restaurantType2);
        $this->restaurantes = [$restaurante1, $restaurante2];
        $this->restaurantesItalianos = [$restaurante2];
        $this->restaurant_types = [$restaurantType1, $restaurantType2];
    }

    public function getItalianRestaurant(): array
    {
        return $this->restaurantesItalianos;
    }

    public function getAllRestaurants(): array
    {
        return $this->entityManager->getRepository(Restaurant::class)->findAll();
        // return $this->restaurantes;
    }

    public function getAllRestaurtantTypes(): array
    {
        return $this->entityManager->getRepository(RestaurantType::class)->findAll();
    }

    public function createRestaurant(RestaurantDTO $newRestaurant): RestaurantDTO
    {
        // Creamos la entidad restaurante
        $newRestaurantEntity = new Restaurant();
        $newRestaurantEntity->setName($newRestaurant->name);

        // Le dices a Doctrine que quieres persistit el objeto,, todavia no hace nada
        $this->entityManager->persist($newRestaurantEntity);

        // Aqui es donde confirmas, asi tienes el concepto de transaccion!!!!
        $this->entityManager->flush();

        // Fijate que se ha cambiado la entidad con el ID nuevo
        $newRestaurant->id = $newRestaurantEntity->getId();
        return $newRestaurant;
    }
}
