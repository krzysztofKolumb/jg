<x-gallery-layout>

    <x-slot name="metatitle">
        <title>{{ $album->title }}</title>
    </x-slot>

    <x-slot name="metadesc">
        <meta name="description" content="{{ $album->description }}">
    </x-slot>

    <x-slot name="title">
        @foreach(str_split($album->name) as $l)
        <span>{{$l}}</span>
        @endforeach
    </x-slot>

    <x-slot name="album">
        {{$album->name}}
    </x-slot>
    <div>
        <div id="grid" class="grid effect-2" data-total-pages="{{$photos->lastPage()}}">
        @foreach($sortedPhotos as $key => $photo)
            <a
                href="storage/img/big/{{$photo->name . '.' . $photo->format}}"
                data-size="{{$photo->large}}"
                data-med="storage/img/medium/{{$photo->name . '.' . $photo->format}}"
                data-med-size="{{$photo->medium}}">
                <img src="{{url('storage/img/thumbs/' . $photo->name . '.' . $photo->format)}}" alt="" />
                <div>
                    <h3>{{ $photo->title }}</h3>
                    <p>{{ $photo->description }}</p>
                </div>
            </a>
        @endforeach 
        </div>

            <div class="options-container">
                <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

                @if(count($photos) > 0)
                <p id="end">KONIEC</p>
                @endif
                @if(count($photos) == 0 )
                <p class="info">Brak zdjęć</p>                
                @endif
            </div>

            <div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left"></button>
                    <button class="pswp__button pswp__button--arrow--right"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-gallery-layout>