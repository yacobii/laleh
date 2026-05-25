<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{

    public function categories()
    {
        return CategoryResource::collection(Category::query()->latest()->paginate());
    }

    public function category(Category $category)
    {

        return new CategoryResource($category);
    }

}
