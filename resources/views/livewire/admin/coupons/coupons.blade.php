<div class="p-10">


    <div>
        @forelse($this->coupons as $coupon)
            <div>
                <a href="">{{ $coupon->title }}</a>
                <p>{{ $coupon->code }}</p>
            </div>
            @empty
            <div>
                <p> کوپن تخفیفی فعال نیست</p>
                <a href="{{ route('admin.coupons.add') }}"><x-icons.plus class="size-8" /></a>
            </div>

        @endforelse
    </div>
</div>
