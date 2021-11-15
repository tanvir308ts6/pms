<x-dashboard-layout>
    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="flex flex-col items-center space-y-3">
            <x-icons.shield class="w-8 h-8 md:w-12 md:h-12 text-gray-400"/>
            <h2 class="text-4xl tracking-wider uppercase font-bold">
                {{ __("Welcome") }}
            </h2>
            <x-user-avatar class="w-44 h-44 md:w-60 md:h-60" src="{{ Auth::user()->image->getUrl() }}"/>
            <span class="text-xl text-gray-500">
                {{ Auth::user()->username }}
            </span>
            <p class="text-2xl text-gray-700">
                {{ Auth::user()->getFullName() }}
            </p>
        </div>
    </div>
</x-dashboard-layout>
