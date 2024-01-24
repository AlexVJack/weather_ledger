<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the Employee resource.
     */
    public function index(): EmployeeCollection
    {
        $employees = Employee::all();
        return new EmployeeCollection($employees);
    }

    /**
     * Display the specified Employee resource.
     */
    public function show(string $id): EmployeeResource|JsonResponse
    {
        try {
            $employee = Employee::findOrFail($id);
            return new EmployeeResource($employee);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }


    /**
     * Store a newly created Employee resource in storage.
     */
    public function store(Request $request): EmployeeResource|JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:65',
            'country' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'salary' => 'required|numeric',
            'position' => 'required|string|max:255'
        ]);

        $employee = Employee::create($validatedData);
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified Employee resource in storage.
     */
    public function update(Request $request, string $id): EmployeeResource|JsonResponse
    {
        try {
            $employee = Employee::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'age' => 'required|integer|min:18|max:65',
                'country' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id,
                'salary' => 'required|numeric',
                'position' => 'required|string|max:255'
            ]);
            $employee->update($validatedData);
            return new EmployeeResource($employee);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }

    /**
     * Remove the specified Employee resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    }

    /**
     * Display a listing of the Employee resource. (Highest salary per country)
     */
    public function highestSalaryPerCountry(): EmployeeCollection
    {
        $employees = Employee::highestSalaryPerCountry()->get();
        return new EmployeeCollection($employees);
    }

    /**
     * Display a listing of the Employee resource. (By position)
     */
    public function employeesByPosition($position): EmployeeCollection
    {
        $employees = Employee::where('position', $position)->get();
        return new EmployeeCollection($employees);
    }

    /**
     * @throws \Exception
     */
    public function getCountry(WeatherService $weatherService)
    {
        $data = $weatherService->getWeatherByCountry('DE');

        dump($data);
        die;

        return [
            'data' => $data
        ];
    }
}
