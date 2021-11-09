@php
/*Colors for this view*/
    $primary = 'yellow';
    $secondary = 'pink';
@endphp

<x-dashboard-layout>
    @include('profile.update-profile-information', ['primary'=>$primary, 'secondary'=>$secondary])
</x-dashboard-layout>
