<?php

namespace App\DTO;

class WeatherDTO
{
    public function __construct(
        public int $id,
        public string $main,
        public string $description,
        public string $icon
    ) {
    }
}
