<x-layouts.app>

    <div class="flex flex-col relative min-h-dvh  size mt-20">

<div class="divide-y">
    @foreach($branches as $branch)
        <div wire:key="{{ $branch->id }}" class="py-4 space-y-1">
            <img class="w-20" src="{{ $branch->getFirstMediaUrl('logo') }}" alt="">
            <p class="text-lg font-bold">{{ $branch->title }} - {{ $branch->city }}</p>
            <p class="flex items-center gap-x-2"><span>تلفن:</span><span>{{ $branch->tel }}</span></p>
            <p class="flex items-center gap-x-2"><span>موبایل:</span><span>{{ $branch->mobile }}</span></p>
            <p class="flex items-start gap-x-2"><span>آدرس:</span><span>{{ $branch->address }}</span></p>
            @if($branch->insta)
               <div class="flex items-center gap-x-2">
                   <a target="_blank" href="https://www.instagram.com/{{ $branch->insta }}">
                       <x-icons.insta width="17" height="17" />
                   </a>
                   <span class="text-sm pt-1">{{ $branch->insta }}</span>
               </div>
            @endif
            <p class="font-bold text-sm">{{$branch->description}}</p>
        </div>
    @endforeach
</div>
    </div>

</x-layouts.app>
