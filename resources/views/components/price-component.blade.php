@props(['price' => $price])
<p class="py-1 text-sm">{{ app(\App\Klass\PersianNumberToWords::class)->convert($price) .' تومان ' ?? null }}</p>
