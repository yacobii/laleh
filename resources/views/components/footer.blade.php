<footer class="w-full px-5 py-10 bg-neutral-100 text-sm">

    <div class="size">

        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            <div>
                <div class="grid gap-4">
                    @foreach(\App\Models\Category::query()->isRoot()->get() as $cat)
                        <div>
                            <a href="{{ route('categories', $cat) }}">{{ $cat->title }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="grid gap-4">
                <a href="{{ route('sefaresh') }}">قوانین ثبت سفارش</a>
                <a href="{{ route('marjoee') }}">قوانین مرجوعی</a>
                <a href="{{ route('kharid') }}">راهنمای خرید</a>
                <a href="{{ route('faq') }}">پرسش های متداول</a>
            </div>
            <div class="grid gap-4">
                <div class="flex items-center gap-2">
                    <p>پشتیبانی</p>
                    <a href="tel:0000000">021-021021</a>
                </div>
                <div class="flex items-center gap-2">
                    <p>واتساپ</p>
                    <a href="tel:0000000">09370000000</a>
                </div>
                <div class="flex items-center gap-2">
                    <p>تلگرام</p>
                    <a href="">cloth_temp</a>
                </div>
                <div class="flex items-center gap-2">
                    <p>اینستا</p>
                    <a href="">cloth_temp</a>
                </div>
            </div>
        </div>

        <div class="py-10 text-justify space-y-4">
            <div class="flex items-center justify-between">
                <p class="md:text-xl font-bold">قالب فروشگاهی پوشاک، کیف و کفش</p>
                <p class="md:text-4xl">SIMPLE TEMP</p>
            </div>
            <p>یک قالب فروشگاهی کامل برای ارائه محصولات و تجارت آنلاین است. در این قالب فروشگاهی تمام امکانات حرفه ای
                برای داشتن یک سایت فروشگاهی آنلاین مهیاست و به مرور تکمیل و روزتر میشود. اطلاعات هویتی و برند هر سایت
                مانند رنگ، لوگو، محتوا و غیره به درخواست خریدار تغییر میکند. این فروشگاه دارای ادمین کامل برای مدیریت
                محصولات و سفارشات است. تمام محصولات قالب های ارائه شده بر اساس ویژگی های سادگی، ارتباط سریع با خریدار،
                کمترین کلیک، واضح و مشخص بودن مسیر خرید، صرفه جویی در زمان و استفاده از آخرین شیوه های روز سیستمهای
                فروشگاهی است که موجب فروش مطلوب برای شما و تجربه خرید دلچسب برای کاربر میشود. همچنین فروشگاه برای سئو
                بیسیک تنظیم و بهینه شده و تمام ویژگی ها لازم برای حضور شما در صفحات گوگل را دارد.</p>
        </div>
        <div class="py-4 text-sm text-red-500 space-y-5 text-justify">
            <p>این قالب فروشگاهی برای فروش پوشاک، کیف، کفش، جوراب و به طور کل محصولاتی است که دارای سایز و رنگ
                هستند توسعه داده شده. کلیه اطلاعات، نام محصول، قیمت، ثبت سفارش، ادمین و اتصال به درگاه فیک هستند و برای
                نمونه در سایت گنجانده شده اند. لذا قابل استناد و ثبت سفارش نیستند.</p>
            <a class="bg-red-500 text-white font-bold px-2 py-1" href="https://wa.me/989122380343">تماس برای راه‌اندازی سایت</a>

        </div>

    </div>

</footer>
