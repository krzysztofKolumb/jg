<x-app-layout>
    <x-slot name="title">
        <title>
            {{ __('Admin | Zdjęcia') }}
        </title>
    </x-slot>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Zdjęcia') }}
        </h2>
    </x-slot>
    <div>
        @livewire('photos')
    </div>
</x-app-layout>