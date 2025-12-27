<x-layouts.app>

<div class="p-32 grid place-items-center">
    <div class="container">
        <h1>پرداخت موفق</h1>
        <p>سفارش شما با موفقیت پرداخت شد.</p>
        <p>شماره سفارش: {{ $order->id }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary">بازگشت به صفحه اصلی</a>
    </div>
</div>

</x-layouts.app>
