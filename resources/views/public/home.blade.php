<x-home-layout>

    <x-slot name="metatitle">
        <title>{{ $page->title }}</title>
    </x-slot>

    <x-slot name="metadesc">
        <meta name="description" content="{{ $page->description }}">
    </x-slot>

    <x-slot name="title">
        @foreach(str_split($page->name) as $l)
        <span>{{$l}}</span>
        @endforeach
    </x-slot>

    <div>
        <div id="intro" class="intro-container fs">
            <div class="bcg"></div>
            <header class="wrapper">
                <h1 class="title">Jan Gietka</h1>
                <p>Photography</p>
            </header>
        </div>
    </div>
</x-home-layout>