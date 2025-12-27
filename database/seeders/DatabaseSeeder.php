<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{


    public function run()
    {

        $this->call(UserSeeder::class);


        $categories = Http::get('https://simpleshop.ir/remote/categories')->collect();

        foreach ($categories as $category) {
            Category::create($category);
        }


        $colors = Http::get('https://simpleshop.ir/remote/colors')->collect();


        foreach ($colors as $color) {
            Color::create($color);
        }

        $sizes = Http::get('https://simpleshop.ir/remote/sizes')->collect();


        foreach ($sizes as $size) {
            Size::create($size);
        }


        $products = Http::get('https://simpleshop.ir/remote/products')->collect();


        foreach ($products as $product){
            Product::create($product);
        }

        $medias = Http::get('https://simpleshop.ir/remote/media')->json();


        foreach ($medias as $media){
            DB::table('media')->insert($media);
        }


        $cps = Http::get('https://simpleshop.ir/remote/color_product')->collect();


        foreach ($cps as $cp){
            DB::table('color_product')->insert($cp);
        }

        $pss = Http::get('https://simpleshop.ir/remote/product_size')->collect();


        foreach ($pss as $ps){
            DB::table('product_size')->insert($ps);
        }


        $texts = Http::get('https://simpleshop.ir/remote/texts')->collect();


        foreach ($texts as $text){
            DB::table('texts')->insert($text);
        }

        $coupons = Http::get('https://simpleshop.ir/remote/coupons')->collect();


        foreach ($coupons as $coupon){
            DB::table('coupons')->insert($coupon);
        }

        $orders = Http::get('https://simpleshop.ir/remote/orders')->collect();


        foreach ($orders as $order){
            DB::table('orders')->insert([
                'id' => $order['id'],
                'user_id' => $order['user_id'],
                'coupon_id' => $order['copen_id'] ?? null,
                'code' => $order['code'],
                'status' => $order['status'],
                'body' => $order['body'],
                'total' => $order['total'],
                'total_with_coupon' => $order['total'],
                'created_at' => $order['created_at'],
                'updated_at' => $order['updated_at'],
            ]);
        }

        $items = Http::get('https://simpleshop.ir/remote/items')->collect();


        foreach ($items as $item){
            DB::table('items')->insert($item);
        }




    }


}
