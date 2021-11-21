<x-app-layout>

    <x-slot name="title">
        <title>
            {{ __('Admin | O mnie') }}
        </title>
    </x-slot>

    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('O mnie') }}
        </h2>
    </x-slot>

    <div>

        @livewire('admin-about')

    </div>

</x-app-layout>