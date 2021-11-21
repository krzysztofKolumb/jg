<div>
    <header class="page-header">
        <div class="container">
            <a class="logo" href="{{ route('home') }}">
                <h1>Jan Gietka</h1>
                <p>Photography</p>
            </a>
        </div>
        <div class="page-nav">
            <button class="menu-button"><span></span></button>
            <div class="container">
                <div class="menu-list">
                    <ul>
                        @foreach($albums as $album)
                        <li><a href="{{ route('gallery', $album->slug) }}">{{$album->name}}</a></li>
                        @endforeach
                        <li><a href="{{ route('about') }}">O mnie</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header> 
</div>