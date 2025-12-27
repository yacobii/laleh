<?php

use Livewire\Volt\Component;

new class extends Component {

    public  \App\Models\User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    protected function rules()
    {
        return [
          'user.name' => 'string',
          'user.ostan' => 'string',
          'user.city' => 'string',
          'user.postal' => 'string',
          'user.address' => 'string',
          'user.email' => 'nullable|email',
          'user.melli' => 'nullable|ir_national_id',
        ];
    }

    public function updated()
    {
        $this->validate();
        $this->user->save();
    }

}; ?>

<div>
    <div class="bg-white profile-card rounded-xl p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-6">

            <div class="flex-1">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">اطلاعات گیرنده سفارشات</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="text-gray-500 text-sm">نام کامل</label>
                        <input type="text" wire:model.live.debounce="user.name" class=" w-full p-2 bg-transparent">
                    </div>
                    <div>
                        <label class="text-gray-500 text-sm">ایمیل</label>
                        <input type="email" wire:model.live.debounce="user.email" class=" w-full p-2 bg-transparent">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-gray-500 text-sm">استان</label>
                        <input type="text" wire:model.live.debounce="user.ostan" class=" w-full p-2 bg-transparent">
                    </div>
                    <div>
                        <label class="text-gray-500 text-sm">شهر</label>
                        <input type="text" wire:model.live.debounce="user.city" class=" w-full p-2 bg-transparent">
                    </div>
                    <div>
                        <label class="text-gray-500 text-sm">کدپستی</label>
                        <input type="text" wire:model.live.debounce="user.postal" class=" w-full p-2 bg-transparent">
                    </div>
                </div>

                <div class="my-4">
                    <div>
                        <label class="text-gray-500 text-sm">آدرس پستی کامل</label>
                        <textarea wire:model.live.debounce="user.address" class=" w-full field-sizing-content w-full p-2 bg-transparent"></textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
