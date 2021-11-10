<x-form-section method="POST" :action="route('profile.update')">
    <x-slot name="title">{{ _("Profile") }}</x-slot>
    <x-slot name="description">{{ _("Update your account's profile information") }}</x-slot>

    <x-slot name="form">
        <!--First Name-->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="first_name"
                     :value="__('First name')"/>

            <x-input id="first_name"
                     class="block mt-2 w-full"
                     :focus-color="$primary"
                     type="text"
                     name="first_name"
                     :value="old('first_name')"
                     placeholder="Enter your first name"
                     required
                     autofocus/>

            <x-input-error for="first_name" class="mt-2"/>
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
