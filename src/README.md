## Weather Ledger

This is a testing project for twnty.de

## Pre-requirements
- Docker
- Docker-compose
- Make
Simple, right :)

## Installation
Clone this repo
```bash
git clone https://github.com/AlexVJack/weather_ledger.git
```

Install it
```bash
make run-app-with-setup-db
make run-app-with-setup-db
```
Yes, exactly two times. From the first attempt, the database may not be ready yet.

Then jump into the container and run seeder for Employees
```bash
make enter-php-container
php artisan db:seed --class=EmployeesTableSeeder
```
