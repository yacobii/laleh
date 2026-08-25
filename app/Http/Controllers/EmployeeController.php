<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\GhorfeOnlineList;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * GET /api/ghorfes/{ghorfe}/employees
     */
    public function employees(Request $request, GhorfeOnlineList $ghorfe)
    {
        $query = $ghorfe->employees()
            ->with(['user', 'services'])
            ->orderByPivot('sort');

        dd($query->toSql(), $query->getBindings(), $query->get());
    }


    /**
     * GET /api/ghorfes/{ghorfe}/employees/{employee}
     */
    public function employee(GhorfeOnlineList $ghorfe, int $employee)
    {
        $employee = $ghorfe->employees()
            ->with([
                'user',
                'services',
            ])
            ->where('employees.id', $employee)
            ->firstOrFail();

        return new EmployeeResource($employee);
    }
}
