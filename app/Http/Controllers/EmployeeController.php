<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function employees()
    {
        return EmployeeResource::collection(Employee::query()
            ->with('user')
            ->latest()->paginate());
    }

    public function employee(Employee $employee)
    {
        //        $employee->load('services');
        return new EmployeeResource($employee);
    }
}
