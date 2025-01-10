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
                <form method="GET" action="{{ route('assignment.presonertask.index') }}">
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

        <div class="card text-right">
            <a href="{{ route('assignment.presonertask.create') }}"
                class="inline-flex items-center px-2 py-1 bg-indigo-700 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 transition"
                style="margin-top:20px; margin-bottom:10px;">
                Assign New Task
            </a>
        </div>

        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Sl</th>
                    <th class="border border-gray-300 px-4 py-2">PIN & Prisoner Name</th>
                    <th class="border border-gray-300 px-4 py-2">Task</th>
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                    <th class="border border-gray-300 px-4 py-2">Start at</th>
                    <th class="border border-gray-300 px-4 py-2">End at</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
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
                        <td class="border px-4 py-2">{{ $item->date }}</td>
                        <td class="border px-4 py-2">{{ $item->start_at }}</td>
                        <td class="border px-4 py-2">{{ $item->end_at }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('assignment.presonertask.show', ['id' => $item->id]) }}"
                                class="inline-flex items-center px-2 py-1 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 transition">
                                <x-icons.edit />
                            </a>
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
