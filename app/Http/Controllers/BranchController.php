<?php

namespace App\Http\Controllers;

use App\Http\Resources\BranchResource;
use App\Http\Resources\ProductResource;
use App\Models\Center;
use App\Models\Product;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function branches()
    {
        return BranchResource::collection(Center::query()
            ->with('services')
            ->latest()->paginate());
    }

    public function branch(Center $branch)
    {
        $branch->load('services');
        return new BranchResource($branch);
    }
}
