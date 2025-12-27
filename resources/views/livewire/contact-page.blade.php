<div class="size px-3 pt-20">

    <form action="" class="space-y-6" >
        <x-honeypot livewire-model="extraFields" />
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label for="">
                    <input type="text" wire:model="name" class="w-full" placeholder="نام">
                </label>
            </div>
            <div>
                <label for="">
                    <input type="text" wire:model="mobile" class="w-full" placeholder="موبایل">
                </label>
            </div>
            <div>
                <label for="">
                    <input type="text" wire:model="email" class="w-full" placeholder="ایمیل">
                </label>
            </div>
        </div>
        <div>
            <label for="">
                <textarea  wire:model="message" class="w-full h-40" placeholder="پیام"></textarea>
            </label>
        </div>
        <div>
            <!-- Google Recaptcha -->
            <div wire:model="captcha" class="g-recaptcha mt-4" data-sitekey={{config('services.recaptcha.key')}}></div>

        </div>
    </form>

@if($errors->any())
    <ul class="list-disc space-y-1 px-5">
        @foreach($errors->all() as $error)
            <li class="text-red-500">{{ $error }}</li>
        @endforeach
    </ul>


@endif
    <div class="text-left">
        <button wire:click="send" class="py-1 text-white hover:bg-gray-700 text-lg px-4 bg-black rounded-lg">ارسال</button>
    </div>

    @session('success')
        <p class="text-emerald-400 font-bold text-center mt-5">{{ $value }}</p>
    @endsession
</div>




