<x-app-layout>

    <x-slot name="title">
        <title>
            {{ __('Admin | Strona główna') }}
        </title>
    </x-slot>

    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Strona główna') }}
        </h2>
    </x-slot>

    <div>

        @livewire('admin-home')

    </div>

</x-app-layout>