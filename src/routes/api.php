<?php

use App\Http\Controllers\API\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::get('/employees/salary/highest', [EmployeeController::class, 'highestSalaryPerCountry']);
Route::get('/employees/position/{position}', [EmployeeController::class, 'employeesByPosition']);
Route::get('/geo', [EmployeeController::class, 'getCountry']);

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    return $request->user();
});
