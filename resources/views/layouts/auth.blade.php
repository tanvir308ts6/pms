<x-app-layout>
    <div class="relative">

        <!--Side-->
        <div class="md:fixed md:w-2/5  {{ $reversColumns ? 'right-0' : 'left-0' }}">
            <div
                class="hidden md:flex justify-center items-center  min-h-screen
                 bg-gradient-to-r from-{{ $primaryColor }}-500 to-{{ $secondaryColor }}-500">

                <div class="text-center text-white space-y-3 p-8">
                    <a href="{{ route('home') }}" class="inline-flex">
                        <x-icons.shield class="w-28 h-28 mx-auto" />
                    </a>
                    <!--Side Title-->
                    <h2 class="text-3xl font-extrabold">
                        {{ $sideTitle ?? __('Prison System') }}
                    </h2>
                    <!--Side Description-->
                    <p class="text-base">
                        {{ $sideDescription ?? __('Web system for the management of a penitentiary center.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Auth Form -->
        <div
            class="absolute flex w-full md:w-3/5 min-h-screen items-center justify-center py-16
             {{ $reversColumns ? 'left-0' : 'right-0' }}">

            <main class="max-w-md w-full h-auto px-4">
                <div class="text-center space-y-2">
                    <a href="{{ route('home') }}" class="inline-flex md:hidden">
                        <x-icons.shield class=" w-14 h-14 mx-auto text-{{ $primaryColor }}-500" />
                    </a>

                    <!--Title Form-->
                    <h2 class="text-2xl md:text-3xl font-bold">
                        {{ $formTitle }}
                    </h2>

                    <!--Description Form-->
                    <p class="text-sm text-gray-500">
                        {{ $formDescription }}
                    </p>

                    <!-- Session Status -->
                    <x-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-4" :errors="$errors" />
                </div>
                <div class="mt-6">
                    {{ $authForm }}
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
