<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Lazy;

new class extends Component {

    public function placeholder(array $params = [])
    {
        return view('livewire.home.slider-loading', $params);
    }

}; ?>

<div class="swiper homerslider">
    <div class="swiper-wrapper">
        <div class="swiper-slide relative">
            <img  class="w-full h-[70dvh] object-cover object-top" src="{{ asset('assets/slides/1.jpeg') }}"
                 alt="">
            <div class="absolute bottom-10 right-4 md:top-32 md:right-48 w-80">
                <div class="relative text-white text-justify">
                    <p class="md:text-2xl">سایت آماده فروشگاهی مناسب فروشندگان آنلاین کیف، کفش، پوشاک و محصولاتی که دارای سایز و رنگ‌های متنوع است.</p>
                    <div class="pt-5 text-center">
                        <li class="py-3 text-red-500"><a href="https://wa.me/989122380343">تماس برای خرید و راه اندازی</a></li>
                    </div>
                </div>
            </div>
        </div>

        <div class="swiper-slide relative">
            <img  class="w-full h-[70dvh] object-cover object-top" src="{{ asset('assets/slides/2.jpeg') }}"
                 alt="">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2">
                <div class="relative text-white">
                    <p class="md:text-7xl font-bold">خرید آنلاین جوراب</p>
                    <div class="pt-5 text-center">
                        <a href="" class="rounded-2xl py-1 text-sm  px-5 bg-white text-black">خریـد</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="swiper-slide relative">
            <img class="w-full h-[70dvh] object-cover object-top" src="{{ asset('assets/slides/3.jpeg') }}"
                  alt="">
            <div class="absolute top-32 left-48">
                <div class="relative text-white text-left">
                    <p class="md:text-7xl font-bold">SHOES</p>
                    <p class="md:text-5xl font-light">MEN - WOMEN</p>

                    <div class="pt-5 text-left">
                        <a href="" class="rounded-2xl py-1 text-sm  px-5 bg-white text-black">خریـد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="next absolute top-1/2 transform -translate-y-1/2 left-4 md:left-10 z-10">
        <x-icons.arrow-left class="size-7 md:size-10 bg-gray-700 text-white p-2"/>
    </div>
    <div class="prev absolute top-1/2 transform -translate-y-1/2 right-4 md:right-10 z-10">
        <x-icons.arrow-right class="size-7 md:size-10 bg-gray-700 text-white p-2"/>
    </div>

    <div class="swiper-pagination"></div>
</div>

