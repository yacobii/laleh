<?php

use Livewire\Volt\Component;

new class extends Component {

    public \App\Models\User $user;



    protected $rules = [
        'user.name' => 'required|string',
        'user.address' => 'required|string',
        'user.postal' => 'required|numeric',
        'user.melli' => 'required|numeric',
        'user.city' => 'required',
    ];


    protected $messages = [
        'user.name' => 'نام  ونام خانوادگی؟',
        'user.address' => 'آدرس؟',
        'user.city' => 'شهر؟',
        'user.postal.required' => 'کدپستی؟',
        'user.postal.numeric' => 'عدد باشد',
        'user.melli.required' => 'کدملی؟',
        'user.melli.numeric' => 'عدد باشد',
    ];

    public $showUpdateMessage = false;

    public function save()
    {
        $val = $this->validate();
        $this->user->save($val);
        $this->showUpdateMessage = true;
        $this->dispatch('refresh');
    }

}; ?>

<div class="fixed bg-gray-800  grid place-items-center inset-0 h-dvh bg-opacity-75 p-5 z-[999]">
    <div
        class="bg-gray-100 rounded-lg bg-opacity-100 relative p-10 space-y-2 checkout-edit-user">
        <button wire:click="$parent.set('show_edit', false)"
                class="absolute left-0 top-0 bg-red-500 p-2 rounded-br-lg text-white">x
        </button>
        <div>
            <label for="">
                <p>نام و نام خانوادگی (به فارسی لطفا)</p>
                <input type="text" wire:model="user.name" class="w-full">
            </label>
            @error('user.name') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="">
                <p>شهر</p>
                <input type="text" wire:model="user.city" class="w-full">
            </label>
            @error('user.city') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div>
            <p>آدرس کامل پستی</p>
            <label for="">
                <textarea name="" wire:model="user.address" id="" cols="30" rows="5" class="w-full"></textarea>
            </label>@error('user.address') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="">
                <p>کد پستی</p>
                <input type="text" wire:model="user.postal" class="w-full">
            </label>
            @error('user.postal') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="">
                <p>کد ملی</p>
                <input type="text" wire:model="user.melli" class="w-full">
            </label>
            @error('user.melli') <p class="error">{{ $message }}</p> @enderror
        </div>
        <div class="text-left">
            <button wire:click="save"
                    class="focus:outline-none rounded-lg py-2 px-4 bg-gray-800 text-sm hover:bg-gray-500 text-white">
                آپدیت اطلاعات
            </button>
        </div>

        <div
            x-show="$wire.showUpdateMessage"
            x-transition
            x-effect="if($wire.showUpdateMessage) setTimeout(() => $wire.showUpdateMessage = false, 2000)">
            <p class="text-green-600 font-bold py-1 px-2 text-sm text-center">اطلاعات با موفقیت آپدیت شد.</p>
        </div>
    </div>
</div>
