<x-app-layout>

    <x-slot name="title">
        <title>
            {{ __('Admin | Albumy') }}
        </title>
    </x-slot>

    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Albumy') }}
        </h2>
    </x-slot>

    <div>

        @livewire('albums')

    </div>

</x-app-layout>