<div class="bg-gray-800  text-white grid h-dvh overflow-y-hidden">

    <div class="w-full md:max-w-lg mx-auto p-5 ">
        <div class="pt-5 text-center">
            <a href="/" class="text-2xl ">
                <x-logo class="w-16 mx-auto" />
            </a>

            @if($showMobile)
                <div class="mx-auto pt-5 w-full">
                    <p class="pb-2">لطفا شماره موبایل خود را وارد کنید</p>
                    <form wire:submit="checkMobile" class="flex items-center h-12">
                        <input type="number" pattern="[0-9]*" wire:model="mobile"
                               class="asinput"
                               placeholder="شماره موبایل...">
                        <button type="submit" class="asbtn">

                            <span wire:loading.remove wire:target="mobile">ثبت موبایل</span>
                            <span wire:loading wire:target="mobile"><x-spin/></span>
                        </button>
                    </form>
                    @error('mobile') <p class="error">{{ $message }}</p> @enderror
                </div>
            @endif

            <p class="text-sm text-red-500 my-2">{{ $msg ?? null }}</p>

            @if($showSMS)
                <div>
                    <div class="mx-auto pt-10 w-full pb-2">
                        <span>کد ارسالی به شماره</span>
                        <span>{{ $mobile }}</span>
                        <span>را وارد کنید</span>
                    </div>


                    <div class="w-full flex items-center justify-between h-12">
                        <label class="w-full">
                            <input type="number" wire:model="sms" pattern="[0-9]{0,4}" class="asinput"
                                   placeholder="کد ارسالی...">
                        </label>
                        <button wire:click="checkCode" class="asbtn">
                            <span wire:loading.remove wire:target="sms">ثبت کد</span>
                            <span wire:loading wire:target="sms"><x-spin/></span>
                        </button>
                    </div>
                    <p class="text-sm mt-2">{{ $errMsg  }}</p>
                    <div class="text-left pt-2">
                        <button wire:click.prevent="changeNumber" class="text-xs text-yellow-300">تصحیح شماره
                        </button>
                    </div>

                </div>
            @endif



            @if($registeration)
                <div class="my-5">
                    <div class="pb-3">
                        <p>لطفا اطلاعات خود را تکمیل کنید.</p>
                    </div>
                    <div class="space-y-6">

                        <div>
                            <label>
                                <input type="text"
                                       class="text-black w-full placeholder:text-gray-400 placeholder:text-sm"
                                       wire:model="name"
                                       placeholder="نام و نام خانوادگی به فارسی ...">
                            </label>
                            @error('name') <p class="error">{{ $message }}</p> @enderror
                        </div>

                        <div class="w-full grid gap-5">

                            <div class="flex gap-4">
                                <div class="w-full">
                                    <label>
                                        <input disabled="disabled" type="text"
                                               class="bg-gray-500 w-full text-black placeholder:text-gray-400 placeholder:text-sm"
                                               wire:model="city"
                                               placeholder="شهر">
                                    </label>
                                    @error('city') <p class="error">{{ $message }}</p> @enderror
                                </div>
                                <div class="w-full ">
                                    <label class="">
                                        <input disabled="disabled" type="text"
                                               class=" w-full bg-gray-500 text-black placeholder:text-gray-400 placeholder:text-sm"
                                               wire:model="ostan"
                                               placeholder="استان">
                                    </label>
                                    @error('ostan') <p class="error">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div>
                                <label>
                                    <textarea disabled="disabled" wire:model="address"
                                              class="bg-gray-500 text-black w-full placeholder:text-gray-400 h-32 placeholder:text-sm"
                                              placeholder="آدرس کامل پستی"></textarea>
                                </label>
                                @error('address') <p class="error">{{ $message }}</p> @enderror
                            </div>
                         <div class="flex gap-4 w-full">
                             <div class="w-full">
                                 <label>
                                     <input disabled="disabled" type="number"
                                            class="bg-gray-500 w-full text-black placeholder:text-gray-400 placeholder:text-sm"
                                            wire:model="postal"
                                            placeholder="کدپستی">
                                 </label>
                                 @error('postal') <p class="error">{{ $message }}</p> @enderror
                             </div>
                             <div class="w-full">
                                 <label>
                                     <input disabled="disabled" type="text"
                                            class="bg-gray-500 w-full text-black placeholder:text-gray-400 placeholder:text-sm"
                                            wire:model="email"
                                            placeholder="ایمیل (اختیاری)">
                                 </label>
                                 @error('email') <p class="error">{{ $message }}</p> @enderror
                             </div>
                         </div>
                            <div>
                                <label>
                                    <input disabled="disabled" type="number"
                                           class="bg-gray-500 w-full text-black placeholder:text-gray-400 placeholder:text-sm"
                                           wire:model="melli"
                                           placeholder="کد ملی">
                                </label>
                                @error('melli') <p class="error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <button
                            wire:click.prevent="create_user"
                            class="bg-green-500 rounded-lg py-2 px-5 disabled:bg-gray-500 text-white focus:outline-none">
                            ثبت نام
                        </button>
                    </div>

                </div>
            @endif
        </div>

    </div>
</div>
