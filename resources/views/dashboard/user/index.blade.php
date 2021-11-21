<x-dashboard-layout>
    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $title }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $description }}
            </p>
        </div>

        <x-table.list>
            <x-slot name="thead">
                <tr>
                    <x-table.th>{{ __("User") }}</x-table.th>
                    <x-table.th>{{ __("Email") }}</x-table.th>
                    <x-table.th>{{ __("State") }}</x-table.th>
                    <x-table.th>{{ __("Actions") }}</x-table.th>
                </tr>
            </x-slot>

            <x-slot name="tbody">

                @foreach($users as $user)
                    <tr>
                        <x-table.td class=" space-x-3 whitespace-nowrap">
                            <x-user-avatar class="hidden md:inline-flex" src="{{  $user->image->getUrl() }}"/>
                            <p class="inline-flex">{{ $user->getFullName() }}</p>
                        </x-table.td>

                        <x-table.td>
                            {{ $user->email }}
                        </x-table.td>

                        <x-table.td>
                            <x-badge :color="$user->state ? 'green' : 'red'">
                                {{ $user->state ? 'active' : 'inactive'}}
                            </x-badge>
                        </x-table.td>

                        <x-table.td class="space-x-3 whitespace-nowrap">
                            <x-link color="gray" class="inline-flex">
                                <x-icons.show/>
                            </x-link>
                            <x-link color="indigo" class="inline-flex">
                                <x-icons.edit/>
                            </x-link>
                            <x-link color="red" class="inline-flex">
                                <x-icons.delete/>
                            </x-link>
                        </x-table.td>
                    </tr>
                @endforeach

            </x-slot>
            <x-slot name="pagination">
                {{ $users->links() }}
            </x-slot>
        </x-table.list>
    </div>
</x-dashboard-layout>
