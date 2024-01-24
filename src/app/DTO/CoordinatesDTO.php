<?php

namespace App\DTO;

class CoordinatesDTO
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {
    }
}
