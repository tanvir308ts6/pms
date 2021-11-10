@php
    /*Colors for this view*/
    $primary = 'indigo';
    $secondary = 'green';
@endphp

<x-dashboard-layout>
    @include('profile.update-profile-information', ['primary'=>$primary, 'secondary'=>$secondary])
</x-dashboard-layout>
