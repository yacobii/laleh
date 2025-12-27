<?php

use App\Models\Category;
use Livewire\Volt\Component;

new class extends Component {

    public \App\Models\User $user;

    protected $rules = [
        'user.tel' => 'ir_phone:true',
        'user.address' => 'required|string',
        'user.postal' => 'required|ir_postal_code',
    ];

    protected $messages = [
        'user.tel.ir_phone:true' => 'شماره تلفن با پیش کد',
        'user.address.required' => 'آدرس ؟',
        'user.postal.required' => 'کد پستی؟',
        'user.postal.ir_postal_code' => 'کد پستی صحیح نیست.',
    ];

    public function save()
    {
        $this->validate();
        $this->user->save();
        $this->dispatch('notify');
    }
}; ?>

<div x-data="{ open: false }" x-init="$watch('open', toggleBodyScroll)" >
    <!-- Trigger -->
    <button @click="open = true" class="outline-none text-red-500 text-xl">
        تغییر اطلاعات
    </button>

    <!-- Backdrop -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"

         @click="open = false" class="fixed inset-0 bg-black/50 backdrop-blur z-40"
         x-cloak
    ></div>

    <!-- Modal -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="fixed  inset-0 flex items-center justify-center z-50"
        x-cloak
    >
        <div @click.outside="open = false" class="bg-white w-full m-5 p-8 rounded-lg shadow-lg max-w-md">
            <h2 class="text-xl mb-4 font-semibold text-gray-700">تغییر اطلاعات</h2>

            <div class="space-y-4">
                <div>
                    <span class="text-xs text-gray-400">تلفن ثابت با پیش کد</span>
                    <input type="text" wire:model.debounce="user.tel" class="w-full border rounded px-4 py-2"
                           placeholder="تلفن">
                </div>
                <div>
                    <span class="text-xs text-gray-400">کدپستی</span>
                    <input type="text" wire:model.debounce="user.postal" class="w-full border rounded px-4 py-2"
                           placeholder="کد پستی">
                </div>
                <div>
                    <span class="text-xs text-gray-400">آدرس گیرنده</span>
                                    <textarea wire:model.debounce="user.address" class="w-full border rounded min-h-24 px-4 py-2"
                                              placeholder="آدرس"></textarea>
                </div>

                <button wire:click="save" class="w-full text-green-500 text-xl">اصلاح اطلاعات</button>

                <x-error/>
                <div x-data="{msg:false}" x-transition x-cloak x-on:notify.window="msg = true" x-show="msg, setTimeout(() => msg = false, 2000)">
                    <p class="text-green-500">با موفقیت آپدیت شد.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleBodyScroll(open) {
        document.body.classList.toggle('overflow-hidden', open);
    }
</script>

