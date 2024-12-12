<?php

namespace App\Model;


class RestaurantDTO
{
    public function __construct(

        public int $id,
        public string $name,
        public RestaurantTypeDTO $resType){}
       
}