<?php

namespace App\Services;

use App\DTO\CoordinatesDTO;
use App\DTO\WeatherDTO;
use App\Exceptions\ApiCallFailedException;
use App\Exceptions\CoordinatesNotFoundException;
use App\Models\Weather;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->apiKey = env('OPENWEATHERMAP_API_KEY');
        $this->baseUrl = env('OPENWEATHERMAP_BASE_URL');
        $this->employeeService = $employeeService;
    }

    /**
     * @throws \Exception
     */
    public function handleWeatherData(): void
    {
        // Get unique country codes array from employees
        $countryCodes = $this->employeeService->getUniqueCountryCodesFromEmployees();

        // Get weather data for each country code and update weather table
        foreach ($countryCodes as $countryCode) {
            $weatherDTO = $this->getWeatherByCountry($countryCode);
            $this->updateWeatherForCountry($weatherDTO);
        }
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
                icon: $weatherData['icon'],
                countryCode: $countryCode
            );
        } catch (\Exception $e) {
            throw new ApiCallFailedException("Weather API call failed for country code: {$countryCode}", 0, $e);
        }
    }

    public function updateWeatherForCountry(WeatherDTO $weatherDTO): void
    {
        Weather::updateOrCreate(
            ['country' => $weatherDTO->countryCode],
            [
                'main' => $weatherDTO->main,
                'description' => $weatherDTO->description,
                'icon' => $weatherDTO->icon,
            ]
        );
    }
}
