<?php

namespace App\Console\Commands;

use App\Services\EmployeeService;
use Illuminate\Console\Command;

class NotifyEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify employees about the weather';

    public function __construct(protected EmployeeService $employeeService) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Notifying employees...');
        try {
            $this->employeeService->notifyUsers();
        } catch (\Exception $e) {
            $this->error("Error notifying employees: " . $e->getMessage());
        }
        $this->info('Notification completed.');
    }
}
