<div class="bg-gray-50  min-h-screen pt-10">
    <div class="size ">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8 px-2">
            <div class="flex gap-1 md:gap-2 text-sm md:text-base">
                <p class="text-gray-600">پروفایل</p>
                <span>/</span>
                <p class="text-gray-600">{{ auth()->user()->name }}</p>
                <span>/</span>
                <p class="text-gray-600">{{ auth()->user()->mobile }}</p>
            </div>
            <a href="{{ route('logout') }}"
                class="logout-btn">
                <span>خروج</span>
            </a>
        </div>

        <!-- Profile Card -->
        <livewire:user-profile-edit/>

        <div x-data="{tab:1}">
            <div class="flex border-b border-gray-200 mb-6">
                <button @click="tab = 1" :class="{'tab-active': tab === 1}" class=" px-4 py-2 mr-4">سفارشات من</button>
                <button @click="tab = 2" :class="{'tab-active': tab === 2}"
                        class="px-4 py-2 text-gray-600 hover:text-indigo-600">علاقمندی‌ها
                </button>
            </div>
            <div x-show="tab === 1" x-cloak>
                <livewire:profile.orders />
            </div>


            <div x-show="tab === 2" x-cloak>
                <livewire:profile.favs />
            </div>
        </div>

    </div>
</div>
