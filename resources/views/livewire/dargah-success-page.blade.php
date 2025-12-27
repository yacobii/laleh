<div class="pt-32 h-full max-w-md mx-auto">
    <div>
        @if(isset($data['status']) && $data['status'] == 0)
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
                @if(isset($data['status']))
                    <p>{{ $data['status'] }}</p>
                @endif
            </div>
        @endif
    </div>
</div>
