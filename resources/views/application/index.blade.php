<x-dashboard-layout>
    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    @if(Auth::user()?->role?->id == 3)
                    {{ __("List of Visitors") }}
                    @else
                    {{ __("List of Applications") }}
                    @endif
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                @if(Auth::user()?->role?->id == 3)
                {{ __("List of Visitors with the role of Visitor and who have been applyed to visit through the system.") }}
                    @else
                    {{ __("List of application with the role of Visitor and who have been applyed to visit through the system.") }}
                    @endif
                    
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="#">
                    <x-search />
                </form>
            </div>
        </div>
        
        <x-.table.list>
            <x-slot name="thead">
                <tr>
                    <x-table.th>{{ __("Applicant Name") }}</x-table.th>
                    <x-table.th>{{ __("Age") }}</x-table.th>
                    <x-table.th>{{ __("Email") }}</x-table.th>
                    <x-table.th>{{ __("Phone") }}</x-table.th>
                    <x-table.th>{{ __("NID/BC No") }}</x-table.th>

                    <x-table.th>{{ __("Relation") }}</x-table.th>
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
                        {{ $application->phone_number }}
                    </x-table.td>

                    <x-table.td>
                        {{ $application->nid_or_birth_certificate_no }}
                    </x-table.td>

                    <x-table.td>
                        {{ $application->relation }}
                    </x-table.td>


                    <x-table.td class="space-x-3 whitespace-nowrap">
                        @if(Auth::user()?->role?->id == 3)
                        <x-link color="gray" class="inline-flex"
                            href="{{ route('visitor.show', ['id' => $application->id]) }}">
                            Print Pass
                        </x-link>

                        @else
                        <x-link color="gray" class="inline-flex"
                            href="{{ route('application.show', ['id' => $application->id]) }}">
                            <x-icons.show />
                        </x-link>
                        @endif
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