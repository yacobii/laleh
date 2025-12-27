<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromView
{

    public function view(): View
    {
        return view('exports.products', [
            'products' => Product::query()->where('active', true)
                    ->whereRelation('variations', 'active', true)
                    ->get(),
        ]);

    }
}
