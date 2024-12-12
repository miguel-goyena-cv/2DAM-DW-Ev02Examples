<?php

namespace App\Model;


class RestaurantTypeDTO
{
    public function __construct(
        public int $id,
        public string $name
    ){}
       
}