<div x-data="{ dropdownOpen: false }" 
    class="relative">
    <button @click="dropdownOpen = ! dropdownOpen" 
        class="flex items-center space-x-2 relative focus:outline-none text-gray-400 hover:text-gray-700"\
        :class="{'text-gray-700': dropdownOpen}">
        {{ $title }}
        <div class="transition-transform transform" :class="{ 'rotate-180': dropdownOpen }">
            <x-icons.chevron-down />
        </div>
    </button>

    <div class="absolute right-0 mt-4 min-w-max sm:min-w-full bg-white rounded-md overflow-hidden shadow-xl z-10" 
        x-show="dropdownOpen"
        x-transition:enter="transition ease-out duration-100 transform" 
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" 
        x-transition:leave="transition ease-in duration-75 transform"
        x-transition:leave-start="opacity-100 scale-100" 
        x-transition:leave-end="opacity-0 scale-95"
        @click.away="dropdownOpen = false">
        
        {{ $options }}
    </div>
</div>
