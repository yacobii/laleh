<div>
    <div class="flex gap-5">
        <p><a href="{{ route('admin.order', $order) }}">code: {{ $order->code }}</a></p>
        @if(auth()->user()->hasRole('super'))
            <button wire:click="deilitOrder" wire:confirm>x</button>
        @endif
    </div>
</div>
