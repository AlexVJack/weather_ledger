<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    public function testEmployeeCreation()
    {
        $employee = Employee::create([
            'name' => 'John Doe',
            'country' => 'US',
            'email' => 'jhon@gmail.com',
            'age' => 25,
            'salary' => 1000,
            'position' => 'Developer'
        ]);

        $this->assertDatabaseHas('employees', [
            'name' => 'John Doe',
            'country' => 'US',
            'email' => 'jhon@gmail.com',
            'age' => 25,
            'salary' => 1000,
            'position' => 'Developer'
        ]);
    }
}
