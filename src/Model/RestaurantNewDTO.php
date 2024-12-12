<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class RestaurantNewDTO
{
    public function __construct(
        #[Assert\NotBlank]
        public int $id,
        #[Assert\NotBlank(message:"El nombre es obligatorio")]
        public string $name,
        #[Assert\NotBlank]
        public int $resType){}
       
}
