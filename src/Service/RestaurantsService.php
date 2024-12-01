<?php
namespace App\Service;

use App\Model\RestauranteNewDTO;

class RestaurantsService
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

    public function getAllRestaurants(): array
    {
       return $this->restaurantes;
    }

    public function getItalianRestaurants(): array
    {
       return $this->restaurantesItalianos;
    }

    public function getRestaurantsById(int $id): array
    {
       return $this->restaurantes[$id];
    }

    public function getRestaurantTypes(): array
    {
       return $this->restaurant_types;
    }

    public function addRestaurant(RestauranteNewDTO $newRestaurant): void
    {
        array_push($this->restaurantes, $newRestaurant);
    }

    public function existRestaurantById(int $id): bool{
        return ($id < sizeof($this->restaurantes));
    }
}