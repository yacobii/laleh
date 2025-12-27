<x-layouts.app>


    <div class="size mx-auto">
        <div class="my-14">
            <p> سفارش {{ $order->code }} </p>
            <p> تشکر از خرید محصولات </p>
        </div>


        @if($order->paymented === 'snapp')
            <div>
                <p>{{ $transactionId }}<p>
            </div>
        @endif
    </div>
</x-layouts.app>
