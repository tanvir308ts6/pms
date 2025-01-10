<x-dashboard-layout>
    <x-form-section :title="'Assign a Task'" :description="'Fill out the details below to assign a new task.'">
        <x-slot name="form">
            <form action="{{ route('assignment.presonertask.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <!-- Task ID -->
                    <div>
                        <x-label for="task_id">Task ID</x-label>
                        <select name="task_id" id="task_id" required
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                            <option value="" class="text-gray-400">Select a Task</option>
                            @foreach ($tasks as $task)
                            <option value="{{ $task->id }}">{{ $task->title }}</option>
                            @endforeach
                        </select>
                        @error('task_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pin Number -->
                    <div>
                        <x-label for="pin_no">Pin Number</x-label>
                        <select name="pin_no" id="pin_no" required
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                            <option value="" class="text-gray-400">Select a Prisoner</option>
                            @foreach ($users as $task)
                            <option value="{{ $task->id }}">{{ $task->id }} - {{ $task->first_name }} {{ $task->last_name }}</option>
                            @endforeach
                        </select>
                        @error('pin_no')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-1 gap-4">
                    <!-- Description -->

                    <x-label for="description">Short Description</x-label>
                    <x-input type="text" name="description" id="description" value="{{ old('description') }}" />
                    @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                </div>
                <br>
                <div class="grid grid-cols-3 gap-4">
                    <!-- Date -->
                    <div>
                        <x-label for="date">Date</x-label>
                        <x-input type="date" name="date" id="date" value="{{ old('date') }}" required />
                        @error('date')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Start Time -->
                    <div>
                        <x-label for="start_at">Start Time</x-label>
                        <x-input type="time" name="start_at" id="start_at" value="{{ old('start_at') }}" required />
                        @error('start_at')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div>
                        <x-label for="end_at">End Time</x-label>
                        <x-input type="time" name="end_at" id="end_at" value="{{ old('end_at') }}" required />
                        @error('end_at')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <br>

                <!-- Assignee ID -->
                <div>
                    <x-input type="hidden" name="ass_id" id="ass_id" value="{{Auth::user()?->id}}" required />
                </div>
                <br><br><br>
                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:ring focus:ring-blue-300">
                        Assign Task
                    </button>
                </div>
            </form>
        </x-slot>
    </x-form-section>
</x-dashboard-layout>