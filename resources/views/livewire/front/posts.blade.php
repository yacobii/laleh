<div x-data="{open:false}" x-ref="box">
    <div  class="w-full">
        <div class="container ">
            <div class="swiper postSlider relative ltr" >
                <div class=" swiper-wrapper">
                    @foreach($post->getMedia('posts') as $media)
                   <div class="swiper-slide" wire:key="{{ $media->id }}">
                       <img class="w-full object-cover" src="{{ $media->getUrl('post') }}" alt="" />
                   </div>
                    @endforeach
                </div>
                <x-icons.chevron-left class="prev absolute size-6 top-1/2 -translate-y-1/2 left-3 z-[99]" />
                <x-icons.chevron-right class="next absolute size-6 top-1/2 -translate-y-1/2 right-3 z-[99]" />
            </div>

            <div class="flex items-center justify-between  pt-3" >
                <p class="text-xl">{{ $post->title }}</p>
                <button x-show="!open" @click="open= ! open" class="text-sm">
                    نمایش بیشتر ...
                </button>
                <button x-show="open" @click="open= ! open" class="text-sm">
                    نمایش کمتر ...
                </button>

            </div>
            <div
                x-show="open"
                x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-10"
                class="py-6">
                <p class="pt-1">{{ $post->body }}</p>
            </div>
        </div>
    </div>
</div>
