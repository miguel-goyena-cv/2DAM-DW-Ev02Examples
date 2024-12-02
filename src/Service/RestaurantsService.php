<?php

namespace App\Service;

use App\Entity\Restaurant;
use App\Entity\RestaurantType;
use App\Model\RestauranteNewDTO;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantsService
{

    public function __construct(private EntityManagerInterface $entityManager) {}

    public function getAllRestaurants(): array
    {
        return $this->entityManager->getRepository(Restaurant::class)->findAll();
    }

    public function getItalianRestaurants(): array
    {
        return $this->entityManager->getRepository(Restaurant::class)->findByType(1);
    }

    public function getRestaurantsById(int $id): Restaurant
    {
        return $this->entityManager->getRepository(Restaurant::class)->find($id);
    }

    public function getRestaurantTypes(): array
    {
        return $this->entityManager->getRepository(RestaurantType::class)->findAll();
    }

    public function addRestaurant(RestauranteNewDTO $newRestaurant): RestauranteNewDTO
    {
        // Creamos la entidad restaurante
        $newRestaurantEntity = new Restaurant();
        $newRestaurantEntity->setName($newRestaurant->name);

        // Preguntamos por el ID del tipo
        $type = $this->entityManager->getRepository(RestaurantType::class)->find($newRestaurant->resType);
        $newRestaurantEntity->setRestType($type);

        // Le dices a Doctrine que quieres persistit el objeto,, todavia no hace nada
        $this->entityManager->persist($newRestaurantEntity);

        // Aqui es donde confirmas, asi tienes el concepto de transaccion!!!!
        $this->entityManager->flush();

        // Fijate que se ha cambiado la entidad con el ID nuevo
        $newRestaurant->id = $newRestaurantEntity->getId();
        return $newRestaurant;

    }

    public function existRestaurantById(int $id): bool
    {
        return ($this->entityManager->getRepository(Restaurant::class)->find($id) != null);
    }
}
