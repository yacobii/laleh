<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ServiceResource;
use App\Models\a\Article;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Service;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::query()
            ->latest()
            ->limit(5)
            ->get();
        $products = ProductResource::collection($products);

        $services = Service::query()
            ->limit(5)
            ->latest()
            ->get();
        $services = ServiceResource::collection($services);

        $employees = Employee::query()
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();
        $employees = EmployeeResource::collection($employees);

        $articles = Article::query()
            ->with('category_article')
            ->select(['id', 'title', 'old_image', 'slug', 'description', 'category_article_id'])
            ->latest()
            ->limit(5)
            ->get();

        $articles = ArticleResource::collection($articles);

        return response()->json([
            'status' => 'success',
            'data' => [
                'products' => $products,
                'services' => $services,
                'employees' => $employees,
                'articles' => $articles,
            ],
        ]);
    }
}
