<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Weather;
use Illuminate\Support\Facades\Log;

class EmployeeService
{
    /**
     * Notify employees about the weather
     * @throws \Exception
     * @return void
     */
    public function notifyUsers(): void
    {
        $batchSize = 100;

        Employee::chunk($batchSize, function ($employees) {
            foreach ($employees as $employee) {
                $weather = Weather::where('country', $employee->country)->first();

                if ($weather) {
                    $message = match ($weather->main) {
                        'Clouds' => "Notification for {$employee->name} ({$employee->email}): It's cloudy in {$employee->country}. Don't forget your umbrella!",
                        'Clear' => "Notification for {$employee->name} ({$employee->email}): The weather is clear in {$employee->country}. A great day for sunglasses!",
                        default => "Notification for {$employee->name} ({$employee->email}): The weather is {$weather->main} in {$employee->country}."
                    };
                    Log::info($message);
                }
            }
        });
    }

    /**
     * @return array of unique country codes ['US', 'DE', 'FR', ...]
     * @throws \Exception
     */
    public function getUniqueCountryCodesFromEmployees(): array
    {
        return Employee::distinct()->pluck('country')->toArray();
    }
}
