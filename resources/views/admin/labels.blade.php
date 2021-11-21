<x-app-layout>

    <x-slot name="title">
        <title>
            {{ __('Admin | Etykiety') }}
        </title>
    </x-slot>

    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Etykiety') }}
        </h2>
    </x-slot>

    <div>

        @livewire('labels')

    </div>

</x-app-layout>