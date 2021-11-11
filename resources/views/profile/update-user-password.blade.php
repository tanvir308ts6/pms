<x-form-section method="POST" :action="route('user-password.update')">
    <x-slot name="formMethodSpoofing">
        @method('PUT')
        @csrf
    </x-slot>
    <x-slot name="title">{{ __("Update password") }}</x-slot>
    <x-slot name="description">{{ __("Make sure your account uses a long, random password to be safe.") }}</x-slot>

    <x-slot name="form">
        <!--Current password-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password"
                     :value="__('Current password')"/>

            <x-input id="current_password"
                     class="block mt-2 w-full"
                     :focus-color="$primary"
                     type="password"
                     name="current_password"
                     placeholder="Enter your current password"
                     maxlength="255"
                     required
                     autofocus/>

            <x-input-error for="current_password" class="mt-2"/>
        </div>

        <!--New password-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password"
                     :value="__('New password')"/>

            <x-input id="password"
                     class="block mt-2 w-full"
                     :focus-color="$primary"
                     type="password"
                     name="password"
                     placeholder="Enter your new password"
                     maxlength="255"
                     required/>

            <x-input-error for="password" class="mt-2"/>
        </div>


        <!--Confirm new password-->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation"
                     :value="__('Confirm Password')"/>

            <x-input id="password_confirmation"
                     class="block mt-2 w-full"
                     :focus-color="$primary"
                     type="password"
                     name="password_confirmation"
                     placeholder="Enter your new password again"
                     maxlength="255"
                     required/>

            <x-input-error for="password_confirmation" class="mt-2"/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button class="min-w-max"
                  :primary-color="$primary"
                  :secondary-color="$secondary">
            {{ __('Update') }}
        </x-button>
    </x-slot>
</x-form-section>
