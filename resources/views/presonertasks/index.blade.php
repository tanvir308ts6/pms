<x-dashboard-layout>
    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("List of Presonar Task ") }} <br> <br>
                </h3>
            </div>
        </div>


        <!-- <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Sl</th>
                    <th class="border border-gray-300 px-4 py-2">Title</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $item)
                <tr style="text-align: center;">
                    <td class="border px-4 py-2">{{ $item->id }}</td>
                    <td class="border px-4 py-2">{{ $item->title }}</td>
                    <td class="border px-4 py-2">
                        <x-badge :color="$item->status === 'Active' ? 'green' : 'red'">
                            {{ $item->status === 'Active' ? 'Active' : 'Inactive'}}
                        </x-badge>
                    </td>
                    <td class="border px-4 py-2">
                        <x-link color="indigo" class="inline-flex"
                            href="{{ route('task.show', ['id' => $item->id]) }}">
                            <x-icons.edit />
                        </x-link>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> -->

    </div>
</x-dashboard-layout>