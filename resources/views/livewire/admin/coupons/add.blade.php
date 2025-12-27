<div>
    <div class="p-6 bg-white rounded-lg shadow-sm">
        @if (session()->has('message'))
            <flux:callout class="mb-4" variant="success">
                {{ session('message') }}
            </flux:callout>
        @endif

        <form wire:submit="save" class="space-y-4">
            <div class="flex flex-col md:flex-row gap-5">
                <input wire:model="title"
                       placeholder="عنوان..."
                       class="w-full {{ $errors->first('title') ? 'border-red-500' : '' }}"
                />
                <input wire:model="code"
                       placeholder="کد..."
                       class="w-full {{ $errors->first('code') ? 'border-red-500' : '' }}"
                />
                <input wire:model="percentage"
                       placeholder="درصد%"
                       min="0"
                       max="100"
                       class="w-full {{ $errors->first('percentage') ? 'border-red-500' : '' }}"
                />
            </div>

            <div class="flex flex-col md:flex-row items-start gap-5">
                <input
                    type="date" class="w-full"
                    wire:model="expired_at"
                    error="{{ $errors->first('expired_at') }}"
                />
                <input wire:model="count"
                       placeholder="تعداد..."
                       class="w-full {{ $errors->first('count') ? 'border-red-500' : '' }}"
                />
            </div>


{{--            <div>--}}
{{--                <flux:switch--}}
{{--                    wire:model="active"--}}
{{--                    label="Active"--}}
{{--                />--}}
{{--            </div>--}}

            <div>
                <button type="submit" class="outline-none py-1 px-4 bg-black text-white">
                    <span wire:loading.remove>ایجاد کوپن</span>
                    <span wire:loading>صبرکنید...</span>
                </button>
            </div>
        </form>
    </div>
</div>
