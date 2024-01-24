<?php

namespace App\Services;

use App\DTO\CoordinatesDTO;
use App\DTO\WeatherDTO;
use App\Exceptions\ApiCallFailedException;
use App\Exceptions\CoordinatesNotFoundException;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
        $this->baseUrl = env('OPENWEATHERMAP_BASE_URL');
    }

    /**
     * @throws \Exception
     */
    public function getWeatherByCountry($countryCode): WeatherDTO
    {
        $country = country($countryCode);
        $coordinates = new CoordinatesDTO(
            latitude: $country->getLatitudeDesc(),
            longitude: $country->getLongitudeDesc()
        );

        if (!$coordinates->latitude || !$coordinates->longitude) {
            throw new CoordinatesNotFoundException("Coordinates not found for the country code: {$countryCode}");
        }

        $url = $this->baseUrl . "?lat={$coordinates->latitude}&lon={$coordinates->longitude}&appid={$this->apiKey}";

        try {
            $response = Http::get($url);
            $weatherData = $response->json()['weather'][0];

            return new WeatherDTO(
                id: $weatherData['id'],
                main: $weatherData['main'],
                description: $weatherData['description'],
                icon: $weatherData['icon']
            );
        } catch (\Exception $e) {
            throw new ApiCallFailedException("Weather API call failed for country code: {$countryCode}", 0, $e);
        }
    }
}
