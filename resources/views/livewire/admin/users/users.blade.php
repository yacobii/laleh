<div class="relative my-5 p-1 md:p-5">
    <div class="flex gap-4">
        <input type="search" class="w-full h-10" placeholder="name" wire:model.live.debounce="term">
        <a href="{{ route('users.export') }}"
           class="px-4 h-10 grid place-items-center outline-none bg-black text-white">excel</a>
    </div>
    <div class="divide-y divide-dashed divide-black">
        @foreach($this->users as $user)
            <div wire:key="{{ $user->id }}" class="flex flex-col gap-x-4 py-4">
                <div class="flex items-center gap-5">
                    @if(auth()->user()->hasRole('super'))
                        <button class="focus:outline-none" wire:confirm wire:click="dilitUser({{$user->id}})">x</button>
                    @endif
                    <p>[{{ $user->id }}]. {{ $user->name }}</p>
                    <p>{{ $user->mobile }}</p>
                </div>
                <p class="text-sm">{{ $user->address }}</p>
                @if($user->orders->count())
                    <div class=" my-4 p-2">
                        <p>سفارشات:</p>
                        @foreach($user->orders as $order)
                            <livewire:admin.users.orders :$order :key="$order->id"/>
                        @endforeach
                    </div>
                @endif

            </div>
        @endforeach
    </div>
    <div>
        {{ $this->users->links() }}
    </div>
</div>
