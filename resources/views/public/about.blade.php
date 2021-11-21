<x-about-layout>

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

        <main>
            <section class="container about-container">
                    <div class="content">
                    @if($page->photo)
                        <figure>
                            <img width="100%" src="{{ url('storage/img/o-mnie/' . $page->photo) }}" alt="Obraz: Jan Gietka">
                        </figure>
                        @endif

                        <article class="about-description">
                            <div>
                                <div class="corner corner-left-top"></div>
                                {!! $page->content !!}
                                <div class="contact">
                                    <p><i class="icon-mobile"></i>{{ $page->phone }}</p>
                                    <p><i class="icon-paper-plane-1"></i> {{ $page->email }}</p> 
                                </div>
                                <div class="corner corner-right-bottom"></div>
                            </div>
                        </article>
                    </div>
                </section>
            </main>

</x-about-layout>