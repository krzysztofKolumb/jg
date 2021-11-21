<x-app-layout>
    <x-slot name="title">
        <title>
            {{ __('Admin | Profil') }}
        </title>
    </x-slot>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div>
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-jet-section-border />
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')
        @endif

    </div>
    <br><br><br>
</x-app-layout>
