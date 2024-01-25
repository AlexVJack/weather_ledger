## Weather Ledger

This is a testing project for twnty.de

## Idea Description
In the test task it is said to save the weather data in the database for every user. 
To save the resources I have decided to save the weather data only for the countries.
Then, when the user will get notification to see the weather advices for the country, 
the app will send the last saved weather data for this country and advices for every user.

This step allows to make much smaller amount of requests to the weather API and save the resources of the server.

Way to get a weather for the country:
1. Get the country longitude and latitude by the country code
2. Get the weather by the longitude and latitude
3. Save the weather data in the database with the country code

I do understand that it is a "denormalized" way to save the data, but it is a good way to save the resources.

## Pre-requirements
- Docker
- Docker-compose
- Make

- It is simple, right? :)

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
For details - check the Makefile

## Usage
### Enter PHP container
```bash
make enter-php-container
```
### Get the weather for the countries
```bash
php artisan weather:update
```
### Send notifications to the users
```bash
php artisan weather:notify
```

## Postman collection
check the file: weather_ledger.postman_collection.json

Best regards,
Alex
:)
