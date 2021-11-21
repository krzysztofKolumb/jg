<x-app-layout>

    <x-slot name="title">
        <title>
            {{ __('Admin | Panel') }}
        </title>
    </x-slot>

    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Panel') }}
        </h2>
    </x-slot>

    @livewire('dashboard')

</x-app-layout>