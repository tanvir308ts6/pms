<x-dashboard-layout>

    <div class="mt-2">
        <x-form-section>

            <x-slot name="title">{{ __("Create a new Task") }}</x-slot>

            <x-slot name="description">
                {{ __("You can register a new Task.") }}
            </x-slot>

            <x-slot name="form">
                <form method="POST" action="{{ route('task.store') }}" class="grid grid-cols-6 gap-6">
                    @csrf

                    <!--Name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="name" :value="__('Name')" />

                        <x-input id="title" class="block mt-2 w-full" type="text" name="title" :value="old('title')"
                            placeholder="Enter the Task name" maxlength="45" required />

                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <!--Location-->
                    <div class="col-span-10 sm:col-span-3">
                        <x-label for="status" :value="__('Status')" />

                        <select class="block mt-2 w-full" id="status" name="status" required 
                        style="border:none; border-bottom:1px solid gray;"
                        >
                            <option value="">{{ __('Select  Status') }}</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>

                        <x-input-error for="location" class="mt-2" />
                    </div>

                    <!--Actions-->
                    <div class="col-span-6 flex justify-end">
                        <x-button class="min-w-max">{{ __('Create') }}</x-button>
                    </div>
                </form>
            </x-slot>

        </x-form-section>
    </div>
</x-dashboard-layout>