<x-layouts.app>

    <div class="pt-32 h-full max-w-md mx-auto">

        <div>
            @if($data['status'] == 0)
                <div>
                    <p>خریدار گرامی</p>
                    <p>پرداخت و خرید شما با موفقیت انجام شد</p>

                <div class="flex items-center gap-5">
                    <p>شماره پیگیری</p>
                    <p>{{ $data['rrn'] }}</p>
                </div>
                    <div class="flex items-center gap-5">
                        <p>شماره کارت</p>
                        <p class="ltr">{{ $data['cardnumber'] }}</p>
                    </div>
                </div>

            @else
                <div>
                    <p>خریدار گرامی</p>
                    <p>پرداخت با موفقیت انجام نشد.</p>
                    <p>{{ $data['status'] }}</p>
                </div>
            @endif
        </div>


    </div>

</x-layouts.app>

