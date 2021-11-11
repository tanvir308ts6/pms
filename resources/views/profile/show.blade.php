@php
    /*Colors for this view*/
    $primary = 'indigo';
    $secondary = 'green';
@endphp

<x-dashboard-layout>
    <div class="mt-2">
        @include('profile.update-profile-information', ['primary'=>$primary, 'secondary'=>$secondary])
    </div>

    <div class="mt-10">
        @include('profile.update-user-password', ['primary'=>$primary, 'secondary'=>$secondary])
    </div>
</x-dashboard-layout>
