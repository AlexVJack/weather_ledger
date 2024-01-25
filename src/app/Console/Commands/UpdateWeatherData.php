<?php

namespace App\Console\Commands;

use App\Services\WeatherService;
use Illuminate\Console\Command;

class UpdateWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the weather data for all unique countries from employees';

    public function __construct(protected WeatherService $weatherService) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Updating weather data...');

        try {
            $this->weatherService->handleWeatherData();
        } catch (\Exception $e) {
            $this->error("Error updating weather data: " . $e->getMessage());
        }

        $this->info('Weather update completed.');
    }
}
