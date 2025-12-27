<div>
    <div class="size mx-auto">
        <div class="my-14">
            <p> سفارش {{ $order->code }} </p>
            <p> تشکر از خرید محصولات ما</p>
        </div>
        @if($order->paymented === 'cart')
            <div class="bg-gray-100 p-3">
                <p>برای نهایی کردن خرید خود، مبلغ کل را کارت به کارت و یا شبا کنید و فیش واریزی را
                    به همراه نام ثبت
                    شده خود در وبسایت  به شماره زیر واتساپ و یا تلگرام کنید.</p>

            </div>
        @endif

        @if($order->paymented === 'snapp')
            <div>
                <p>{{ $order->transactionId ?? null }}<p>
                <p>{{ $messaage }}<p>
            </div>
        @endif

        <div class="mt-5">
            <div class="flex items-center gap-8">
                <a class="py-1 px-4 rounded-lg bg-slate-900 text-white" href="{{ route('home') }}">بازگشت به سایت</a>
                <a class="py-1 px-4 rounded-lg bg-slate-900 text-white" href="{{ route('products') }}">محصولات</a>
            </div>
        </div>
    </div>

</div>
