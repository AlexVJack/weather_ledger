<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            // Employees from the United Kingdom
            [
                'name' => 'John Doe',
                'age' => 28,
                'country' => 'GB',
                'email' => 'jhon@gmail.com',
                'salary' => 3500.00,
                'position' => 'Software Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Jane Doe',
                'age' => 25,
                'country' => 'GB',
                'email' => 'jane@gmail.com',
                'salary' => 3000.00,
                'position' => 'Software Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Mark Doe',
                'age' => 30,
                'country' => 'GB',
                'email' => 'mark@gmail.com',
                'salary' => 4000.00,
                'position' => 'Software Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            // Employees from the Germany
            [
                'name' => 'Max Mustermann',
                'age' => 28,
                'country' => 'DE',
                'email' => 'max@gmail.com',
                'salary' => 3500.00,
                'position' => 'Software Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Erika Mustermann',
                'age' => 25,
                'country' => 'DE',
                'email' => 'erica@gmail.com',
                'salary' => 3000.00,
                'position' => 'Software Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Hans Mustermann',
                'age' => 30,
                'country' => 'DE',
                'email' => 'hans@gmail.com',
                'salary' => 4000.00,
                'position' => 'Software Engineer',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
