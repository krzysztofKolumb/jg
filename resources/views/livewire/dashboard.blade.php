<div>
    <div class="panel-container">
        <ul class="panel-nav">
            <li><a type="button" href="{{ route('photos') }}" class="btn btn-dark text-uppercase">Zdjęcia</a></li>
            <li><a type="button" href="{{ route('albums') }}" class="btn btn-dark text-uppercase">Albumy</a></li>
            <li><a type="button" href="{{ route('admin-home') }}" class="btn btn-dark text-uppercase">Strona Główna</a></li>
            <li><a type="button" href="{{ route('admin-about') }}" class="btn btn-dark text-uppercase">O mnie</a></li>
            <li><a type="button" href="{{ route('profile.show') }}" class="btn btn-dark text-uppercase">Profil</a></li>
        </ul>
        <ul class="panel-stat">
            <li>
                <div></div>
                <div>Liczba zdjęć</div>
                <div>Rozmiar</div>
            </li>
            @foreach($albums as $album)
            <li>
                <div>{{ ucfirst($album->name) }}</div>
                <div>{{ $album->photos()->count() }} </div>
                <div>{{ $this->formatSizeUnits($album->sumSizePhotos($album->id))}}</div>
            </li>
            @endforeach
            <li>
                <div></div>
                <div>{{ $photos }} </div>
                <div>{{ $this->formatSizeUnits($allPhotosSize) }} </div>
            </li>
        </ul>
    </div>
</div>
