<x-layout>
    <x-slot name="header">
        <h2>
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        ''
    </x-slot>
    <div>
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
    </div>
</x-layout>
