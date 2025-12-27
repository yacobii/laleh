<div class="size pt-20">

   <div>
       @if($this->cart->contentsCount())
           <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
               <div class="flex flex-col gap-4">
                   <div class="w-full md:w-fit flex flex-col divide-y divide-dashed divide-gray-500">
                       @foreach($this->cart->contents() as $item)
                           <livewire:cart-items :$item :key="'item-'.$item->id"/>
                       @endforeach
                   </div>



               </div>

               <div class="" >
                   <div class="sticky top-10 text-xl space-y-4">
                       <div class="flex items-center gap-2 justify-center md:justify-start">
                           <span>جمع کل:</span>
                           <p>{{ number_format($this->cart->total()) }} <span>تومان</span></p>
                       </div>
                       <div class="w-full md:w-fit">
                           <div class="flex">
                               <input class="h-10 w-full text-black" type="text" wire:model="code" placeholder="کد تخفیف...">
                               <button class="h-10 bg-gray-500 px-4 text-sm shrink-0 text-white" wire:click="add_coupon">ثبت کد</button>
                           </div>
                           <p class="text-sm text-red-500 mt-1">{{ $coupon_message }}</p>
                       </div>

                       @if($this->coupon)
                           <div>
                               <p>جمع کل با تخفیف:</p>
                               <p>{{ number_format($this->discountedTotal()) }} <span>تومان</span></p>
                           </div>
                       @endif

                       <div>
                           <button
                               wire:click="add_order"
                               class="text-green-500 outline-none text-2xl">ثبت سفارش
                           </button>
                       </div>
                       <x-price-component :price="$this->cart->total()" />
                   </div>
               </div>
           </div>

       @else
           <div>
               <a href="{{ route('home') }}">products</a>
           </div>
       @endif
   </div>
</div>
