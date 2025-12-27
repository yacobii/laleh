<div class="fixed top-0 mx-auto w-full z-50 bg-gray-100">
    <!-- MOBILE -->
    <header x-data="{open:false}"
            class="lg:hidden w-full p-3  flex mx-auto items-center justify-center">
        <div class="container mx-auto flex items-center justify-between">

            <ul class="flex items-center gap-x-4">
                <li>
                    <button @click="open = !open" class="block">
                        <x-icons.bar-3 class="size-8"/>
                    </button>
                </li>

                <button @click.stop="$dispatch('mary-search-open')" class="outline-none">
                    <x-icons.search/>
                </button>


            </ul>

            <a class="text-red-500 text-sm" target="_blank" href="https://wa.me/989122380343">تماس برای راه‌اندازی
                سایت</a>

            <div class="flex items-center gap-4">
                @if(!Route::is('cart'))
                    <livewire:menu-cart/>
                @endif
                <div>
                    <x-logo/>
                </div>
            </div>

        </div>

        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-full"
             x-cloak class="bg-white w-full fixed mx-auto lg:max-w-md text-black    z-[999] inset-0 h-full">

            <div class="">
                <div class="bg-gray-200 text-black flex items-center justify-between p-3">
                    <x-logo class="size-8"/>
                    <div>
                        <button @click="open = false">
                            <x-x-mark class="size-8"/>
                        </button>
                    </div>
                </div>

                <ul class="divide-y px-5 py-2">
                    <li class="py-3"><a href="/">خانه</a></li>
                    <li class="py-3"><a href="{{ route('products') }}">تمامی محصولات</a></li>
                    <livewire:header-categories/>

                    <li class="py-3"><a href="{{ route('about-us') }}">درباره ما</a></li>
                    <li class="py-3"><a href="{{ route('contact') }}">تماس با ما</a></li>
                    @guest
                        <li class="py-3"><a href="{{ route('login') }}">ورود</a></li>
                    @endguest
                    @auth
                        <li class="py-3">
                            <livewire:logout-component/>
                        </li>
                    @endauth

                    <li class="py-3">
                        <a href="{{ route('admin.orders') }}">پنل ادمین</a>
                    </li>

                </ul>

            </div>
        </div>
    </header>


    <!-- DESKTOP -->
    <header
        class="hidden lg:flex w-full h-14 mx-auto bg-white text-black border-b items-center  justify-center">
        <div class="flex items-center container md:max-w-6xl 2xl:max-w-7xl mx-auto px-5 justify-between">
            <ul class="flex items-center text-sm lg:text-base lg:gap-5 2xl:gap-10">
                <li class=""><a href="/">خانه</a></li>

                <div class="flex flex-col relative">
                    <li class=""><a href="{{ route('products') }}">محصولات</a></li>
                </div>
                <li class=""><a href="{{ route('about-us') }}">درباره ما</a></li>
                <li class=""><a href="{{ route('contact') }}">تماس</a></li>
                @guest
                    <li class=""><a href="{{ route('login') }}">ورود</a></li>
                @endguest
                @auth
                    <a href="{{ route('profile') }}">پروفایل</a>
                @endauth
                <li class="py-3 text-red-500"><a href="https://wa.me/989122380343">تماس برای راه‌اندازی سایت</a></li>
                <li>
                    <button @click.stop="$dispatch('mary-search-open')" class="focus:outline-none">
                        <x-icons.search/>
                    </button>
                </li>
            </ul>
            <div class="flex items-center gap-4">
                @if(!Route::is('cart'))
                    <livewire:menu-cart/>
                @endif
                <div>
                    <img class="h-12" src="{{ asset('logo/logo.svg') }}" alt="">
                </div>
                <div>
                    <a href="{{ route('admin.orders') }}">پنل ادمین</a>
                </div>
            </div>
        </div>
    </header>
</div>
