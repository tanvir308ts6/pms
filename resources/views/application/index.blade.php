<x-dashboard-layout>
    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("List of Applications") }}
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("List of application with the role of Visitor and who have been applyed to visit through the system.") }}
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="#">
                    <x-search />
                </form>
            </div>
        </div>
        <x-table.list>
            <x-slot name="thead">
                <tr>
                    <x-table.th>{{ __("Applicant Name") }}</x-table.th>
                    <x-table.th>{{ __("Age") }}</x-table.th>
                    <x-table.th>{{ __("Email") }}</x-table.th>
                    <x-table.th>{{ __("Phone") }}</x-table.th>
                    <x-table.th>{{ __("NID/BC No") }}</x-table.th>
                    <x-table.th>{{ __("Gender") }}</x-table.th>
                    <x-table.th>{{ __("PIN No") }}</x-table.th>
                    <x-table.th>{{ __("Relation") }}</x-table.th>
                    <x-table.th>{{ __("State") }}</x-table.th>
                    <x-table.th>{{ __("Actions") }}</x-table.th>
                </tr>
            </x-slot>

            <x-slot name="tbody">

                @foreach($applications as $application)
                <tr>
                    <x-table.td class=" space-x-3 whitespace-nowrap">
                        <p class="inline-flex">{{ $application->full_name }}</p>
                    </x-table.td>

                    <x-table.td>
                        {{ $application->age }}
                    </x-table.td>
                    <x-table.td>
                        {{ $application->email }}
                    </x-table.td>

                    <x-table.td>
                        {{ $application->phone }}
                    </x-table.td>

                    <x-table.td>
                        {{ $application->nid_or_birth_certificate_no }}
                    </x-table.td>

                    <x-table.td>
                        {{ $application->gender }}
                    </x-table.td>

                    <x-table.td>
                        {{ $application->pin_no }}
                    </x-table.td>

                    <x-table.td>
                        {{ $application->relation }}
                    </x-table.td>

                    <x-table.td>
                        <x-badge :color="$application->state === 1 ? 'green' : 'red'">
                            {{ $application->state === 1 ? 'approved' : ($application->state === 0 ? 'rejected' : 'pending') }}
                        </x-badge>
                    </x-table.td>

                    <x-table.td class="space-x-3 whitespace-nowrap">
                    <x-link color="gray" class="inline-flex"
                                    href="{{ route('application.show', ['id' => $application->id]) }}">
                                <x-icons.show/>
                            </x-link>
                    </x-table.td>

                </tr>
                @endforeach

            </x-slot>
            <x-slot name="pagination">
                {{ $applications->links() }}
            </x-slot>
        </x-table.list>


    </div>

</x-dashboard-layout>