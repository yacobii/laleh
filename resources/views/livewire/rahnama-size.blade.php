<div class="fixed w-full h-screen  overflow-hidden inset-0 bg-gray-800/80 backdrop-blur mx-auto z-[999]">
    <div class="w-full relative grid place-items-center h-screen  mx-auto" @click.outside="size=false">
        <div class="absolute top-10 left-10">
            <button @click="size=false"
                class="bg-red-500 rounded-full text-white w-8 h-8 grid place-items-center">
                <span>x</span>
            </button>

        </div>

        <img class="w-full max-h-screen object-contain" src="{{ $product->getFirstMediaUrl('table', 'table') }}" alt="">
    </div>
</div>
