<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class SnappShopController extends Controller
{
    public function __invoke()
    {
        $baseUrl = 'https://apix.snappshop.ir/automation/v1';
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxMDQiLCJqdGkiOiIyMDFlOWIxM2JkNjRiZjZjZjc3MTM5MzVjZDE2ODYzYmUzZDZkMjdjNTMyNGE2NTBjMmQ5YzBmYWFmNDc2NDJiN2Q3YjNlNmY5MDdjNGZjZiIsImlhdCI6MTc0NjU0MzA1MC4zNzU0NjYsIm5iZiI6MTc0NjU0MzA1MC4zNzU0NjgsImV4cCI6MTc3ODA3OTA1MC4zNjk2MSwic3ViIjoiMzAyIiwic2NvcGVzIjpbXX0.JoDhEh6AAz6st4UYoG2LHruPTJx8lcrtEU26iuVgZ6wci3ibizXJNm-ADx7lt0Cy9E058ql-XeDvkQ0yjw_N2e6Z9kQ58R-BainzZ0s2J1b3AOMI3Gw_4qGZ5yxx-MCFWn8l1YyI6NNTptdn1Oiv4hcjBdbjkLH9SDJnquZOGwYHI6RL-zrufYq5iQVRO7PUGqWTUwWCxei07Zh7OQnK-uBBI2QOXi3SvgflyLrPoHLC6KVEs1USWndMZAKqdeZ0jmQiB9P6nfwXKKQ5KxLAq9YVLJ3IDM8fGDj9kAGOKmLSnNoVk-g40vwgtXVUTk2HCcuujA1z_Y0LxMa6U-u7jMNLoub6E0K8-JTXXgdi7S3FXikLZk505EFho-G08gKjRtdYigM5L9rx3lYMPKOUvPEVatNSL2221mBY2UN_W9YlXCAnZ1c8JI_gPy0r1g6YE9iZ5Li_FHkxB9rseeVWXNPshAHdyHsBTK6Le5uuvYYuVK2a2rAjGtfDApdct8UmlpoA0k7oaNxghnY5Ynkw2cxMgFhmad6LwlSrT3i9xCojmUZRww3IPRwlCvbfXiARE4oiIyPLkLubIHK2UCi1QamP8qIPogBcKexa0WF6qEhgC04Lmm5UZFaVhpFZnOA6dR9SRkp3VEhIm8Adkd9DxZN7pcv2e5MLcQVJ37Kpefc';
        $page = request()->get('page', 1);
        $perPage = 20;
        $res = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get($baseUrl . "/vendors/09kxMZ/products", [
            'page' => $page,
            'per_page' => $perPage
        ]);

        $response = $res->json();

        $products = collect($response['data'])->map(fn($item) => (object) $item); // optional: convert to object

        // Build Laravel paginator
        $paginator = new LengthAwarePaginator(
            $products,
            $response['meta']['pagination']['total'],  // total items
            $response['meta']['pagination']['per_page'], // per page
            $response['meta']['pagination']['current_page'], // current page
            ['path' => url()->current()] // preserve URL path
        );

        return view('snappshop.products', ['products' => $paginator]);
    }
}
