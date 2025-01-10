<x-dashboard-layout>
    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("List of Prisoner Tasks") }}
                    <br><br>
                </h3>
            </div>
            <div class="col-span-6 md:col-span-2 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="{{ route('assignment.presonertask.report') }}">
                    <div class="flex items-center space-x-2">
                        <input type="date" name="date"
                            class="border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                            value="{{ request('date') }}">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring focus:ring-blue-300">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Sl</th>
                    <th class="border border-gray-300 px-4 py-2">PIN & Prisoner Name</th>
                    <th class="border border-gray-300 px-4 py-2">Task</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                    <th class="border border-gray-300 px-4 py-2">Start</th>
                    <th class="border border-gray-300 px-4 py-2">End</th>
                    <th class="border border-gray-300 px-4 py-2">Marks</th>
                    <th class="border border-gray-300 px-4 py-2">Remarks</th>
                    <th class="border border-gray-300 px-4 py-2">Task Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $index => $item)
                <tr class="hover:bg-gray-50 text-center">
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">
                        {{ $pin_data[$index]->id ?? 'N/A' }} -
                        {{ $pin_data[$index]->first_name ?? 'N/A' }}
                        {{ $pin_data[$index]->last_name ?? '' }}
                    </td>
                    <td class="border px-4 py-2">{{ $task_data[$index]->title ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $item->description ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $item->date }}</td>
                    <td class="border px-4 py-2">{{ $item->start_at ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $item->end_at ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">{{ $item->marks ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $item->remarks ?? '-' }}</td>


                    <td class="border px-4 py-2">

                        <x-badge
                            :color="$item->task_status === '1' ? 'green' : ($item->task_status === '2' ? 'red' : 'yellow')">
                            {{ $item->task_status === '1' ? 'Accepted' : ($item->task_status === '2' ? 'Rejected' : 'Pending') }}
                        </x-badge>



                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="border px-4 py-2 text-center text-gray-500">No data found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-dashboard-layout>