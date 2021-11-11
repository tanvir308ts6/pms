<x-app-layout>
    <!-- component -->
    <div x-data="{ sidebarOpen: false }">
        <div class="flex h-screen bg-gray-100">
            <!--It is a background that is activated when the screen size is 768px and the sidebar is displayed-->
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                 class="fixed z-20 inset-0 bg-black opacity-60 transition-opacity lg:hidden"></div>

            <!--Sidebar-->
            <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                 class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform border  border-l shadow-sm bg-white overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">

                <div class="flex items-center justify-center h-14 space-x-2 mx-5 border-b-2">
                    <x-icons.shield class="w-8 h-8 text-gray-500"/>
                    <span
                        class="text-gray-800 dark:text-white text-2xl font-semibold">{{ Auth::user()->role->name }}</span>
                </div>

                <!--Sidebar options-->
                <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
                    <x-dropdown-sidebar title="Hello world">
                        <x-slot name="icon">
                            <x-icons.home/>
                        </x-slot>
                        <x-slot name="options">
                            <x-dropdown-sidebar-link :href="route('home')">{{ __('Home') }}</x-dropdown-sidebar-link>
                            <x-dropdown-sidebar-link :href="route('home')">{{ __('Home') }}</x-dropdown-sidebar-link>
                            <x-dropdown-sidebar-link :href="route('home')">{{ __('Home') }}</x-dropdown-sidebar-link>
                        </x-slot>
                    </x-dropdown-sidebar>

                    <x-dropdown-sidebar title="Hello world">
                        <x-slot name="icon">
                            <x-icons.home/>
                        </x-slot>
                        <x-slot name="options">
                            <x-dropdown-sidebar-link :href="route('home')">{{ __('Home') }}</x-dropdown-sidebar-link>
                            <x-dropdown-sidebar-link :href="route('home')">{{ __('Home') }}</x-dropdown-sidebar-link>
                            <x-dropdown-sidebar-link :href="route('home')">{{ __('Home') }}</x-dropdown-sidebar-link>
                        </x-slot>
                    </x-dropdown-sidebar>
                </nav>
            </div>

            <!--Main view-->
            <div class="flex flex-col">
                <!--Navbar-->
                <header class="flex flex-shrink-0 h-14  justify-between lg:justify-end items-center bg-white shadow-md px-5 z-0">
                    <div class="flex items-center lg:hidden">
                        <!--Menu option-->
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none">
                            <x-icons.menu class="w-7 h-7"/>
                        </button>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!--Notification option-->
                        <button class="flex text-gray-400 hover:text-gray-700 focus:outline-none">
                            <x-icons.notification/>
                        </button>

                        <!--User options-->
                        <x-dropdown-navbar>
                            <x-slot name="title">
                                <span
                                    class="text-current text-sm hidden sm:block">{{ Auth::user()->getFullName() }}</span>
                                <x-user-avatar src="{{ Auth::user()->image->path }}"/>
                            </x-slot>
                            <x-slot name="options">
                                <x-dropdown-navbar-link :href="route('profile')">{{ __('Profile') }}
                                </x-dropdown-navbar-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-navbar-link :href="route('logout')"
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log out') }}
                                    </x-dropdown-navbar-link>
                                </form>
                            </x-slot>
                        </x-dropdown-navbar>
                    </div>
                </header>

                <!--Content-->
                <main class="overflow-x-hidden overflow-y-auto">

                    <!-- Page Content -->
                    <div class="px-6 py-8">
                        <!-- Session Status -->
                        <x-session-status class="mb-4 text-center" :status="session('status')"/>

                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>
