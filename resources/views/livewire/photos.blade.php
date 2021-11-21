<div>
    <div class="options-container">
        <div class="group-1 flex-wrapper">
            <div>
                <button type="button" class="btn btn-primary btn-new" wire:click="openModal">Dodaj zdjęcie</button>
            </div>
            @if($activeLabel)
            <div>
                <div class="active-label">
                    <span>{{ $activeLabel->name }}</span>
                    <img wire:click="closeActiveLabel()" width="18px" src="{{url('storage/img/icon-close.png') }}">
                </div>
            </div>
            @endif
            <div id="total-wrapper">
                <h6>Liczba zdjęć</h6>
                <p class="total">{{ $totalPhotosNo }}</p>
            </div>
        </div>
        <div class="group-2 group">
            <div class="group-item">
                <h6>Album</h6>
                <select class="form-control" wire:model="album" wire:ignore.self wire:change="changeSearch">
                    @foreach($albums as $album)
                    <option value="{{ $album->id }}" required>
                        {{ $album->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="group-item">
                <h6>Znajdź zdjęcie</h6>
                <div class="flex-wrapper">
                    <input type="text" placeholder="Wpisz fragment tytułu" class="form-control no-b search-input" wire:model="searchTerm">
                </div>
            </div>
            <div class="group-item group-sort">
                <h6>Sortowanie</h6>
                <select class="form-control sort-by" wire:model="sortBy" wire:ignore.self>
                    <option value="1" selected>Od najnowszych (data dodania)</option>
                    <option value="2">Od najnowszych (data wykonania)</option>
                    <option value="3">Od najstarszych (data dodania)</option>
                    <option value="4">Od najstarszych (data wykonania)</option>
                </select>
            </div>
        </div>

        <div class="group group-5">
            <div class="buttons-cont">
                <div class="btn-div btn-labels" wire:click="show()">
                    <span class="btn-label">Etykiety </span>
                    <span> <img width="25px" src="{{ url('storage/img/icon-arrow-down.png') }}"></span>
                </div>
            </div>
        </div>

        <div class="group-4">
            @if($showLabels == 'true')
            <div class="buttons-cont">
                @foreach($labels as $index => $label)
                <div class="btn-div {{ $activeLabelId==$label->id ? 'active' : '' }}" wire:click="activeLabel({{$label->id}})">
                    <span class="btn-label">{{ $label->name }}</span>
                    <span class="badge badge-pill badge-light">{{ count($label->photos) }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="group group-3">
            <div class="buttons-cont">
                <div class="btn-div {{ $visible=='all' ? 'active' : ''}}" wire:click="visible('all')">
                    <span class="btn-label">Wszystkie</span>
                    <span class="badge badge-pill badge-dark">{{$totalAlbumPhotosNo}}</span>
                </div>
                <div class="btn-div {{ $visible==1 ? 'active' : ''}}" wire:click="visible(1)">
                    <span class="btn-label">Publiczne</span>
                    <span class="badge badge-pill badge-dark">{{$totalPublicPhotosNo}}</span>
                </div>
                <div class="btn-div {{ $visible==2 ? 'active' : ''}}" wire:click="visible(2)">
                    <span class="btn-label">Ukryte </span>
                    <span class="badge badge-pill badge-dark">{{$totalHiddenPhotosNo}}</span>
                </div>
            </div>
            <div>
            </div>
            <div id="pagination-top" class="{{ $photos->lastPage() ==1 ? '' : 'bottom' }}">
                <span class="pagin-info">{{ $photos->firstItem()==0 ? '0 ' : $photos->firstItem() }}&#8212;{{$photos->lastItem()}} z {{$photos->total()}} </span>
                {{ $photos->render() }}
            </div>
        </div>
    </div>

    @foreach($photos as $photo)
    <div class="row">
        <div class="col-md-4">
            <div class="px-4 px-sm-0">
                <div class="d-flex justify-content-between">
                    <div class="photo-container">
                        <img width="100%" src="{{url('storage/img/thumbs/' . $photo->name . '.' . $photo->format)}}">
                    </div>
                    <div></div>
                </div>
            </div>    
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="w-md-75">
                        <div class="photo-desc">
                            <div>
                                <p>Tytuł </p>
                                <p class="title">{{ $photo->title }}</p>
                            </div>
                            <div>
                                <p>Opis </p>
                                <p>{{ $photo->description }}</p>
                            </div>
                            <div>
                                <p>Album </p>
                                <p>{{ $photo->album->name }}</p>
                            </div>
                            <div class="datetime-wrapper">
                                <p>Wykonano </p>
                                <p>{!! $this->formatDate($photo->date_taken, $photo->time_zone) !!} </p>
                            </div>
                            <div class="datetime-wrapper">
                                <p>Dodano </p>
                                <p>{!! $this->formatDate($photo->created_at, 'Europe/Warsaw') !!} </p>
                            </div>
                            <div class="format-wrapper">
                                <p>Rozmiar </p>
                                <p>
                                    <span class="dimension">{{ $photo->large }} - </span><span class="size">{{ $this->formatSizeUnits($photo->large_size) }}</span><br>
                                    <span class="dimension">{{ $photo->medium }} - </span><span class="size">{{ $this->formatSizeUnits($photo->medium_size) }}</span><br>
                                    <span class="dimension">{{ $photo->small }} - </span><span class="size">{{ $this->formatSizeUnits($photo->small_size) }}</span>
                                </p>
                            </div>
                            <div>
                                <p>Format </p>
                                <p>{{$photo->format }}</p>
                            </div>
                            @if( count($photo->labels) > 0)
                            <div>
                                <p>Etykiety </p>
                                <p class="labels">
                                    @foreach($photo->labels as $label)
                                        <span>{{ $label->name }}</span>
                                    @endforeach
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-space-between">
                    <div class="custom-control custom-switch">
                        <input wire:click="selectedItem( {{$photo->id}} , 'public' )" type="checkbox" {{ $photo->visible == 1 ? 'checked' : ''}} class="custom-control-input" id="customSwitch-{{$photo->id}}">
                        <label class="custom-control-label" for="customSwitch-{{$photo->id}}">{{ $photo->visible == 1 ? 'Publiczne' : 'Ukryte'}}</label>
                    </div>
                    <div>
                        <button class="btn btn-dark text-uppercase" wire:click="selectedItem( {{$photo->id}} , 'update' )">Edytuj</button>
                        <button class="btn btn-dark text-uppercase" wire:click="selectedItem( {{$photo->id}} , 'delete' )">Usuń</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-jet-section-border />
    @endforeach

    @if(count($photos) == 0)
    <!-- <x-jet-section-border /> -->
    <h5 id="info">brak zdjęć<h5>
    @endif

    @if($photos)
    <div class="pagination-wrapper">
        {{ $photos->render() }}
    </div>
    @endif
    <div class="modal fade" wire:ignore.self id="photo-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zdjęcie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($photoOrientation=='h')
                    <img width="300px" src="{{url('storage/img/thumbs/' . $deletedPhotoName)}}">
                    @else
                    <img width="200px" src="{{url('storage/img/thumbs/' . $deletedPhotoName)}}">
                    @endif
                    <div>
                        <h5>Czy na pewno chcesz trwale usunąć to zdjęcie?</h5>
                        <div class="btns-wrapper">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                            <button type="submit" wire:click="delete" class="btn btn-primary">Usuń</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="photo-modal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div id="modal-content" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zdjęcie</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bcg">
                    <div class="modal-body-container">
                        <div wire:loading wire:target="file" wire:ignore.self>
                            <div id="spinner-container">
                                <div class="lds-spinner">
                                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                                </div>
                            </div>
                        </div>
                        @if(!$file && $action=='create')
                        <div class="photo-input-wrapper">
                            <div class="photo-input">
                                <input type="file" wire:model="file" id="file" accept="image/*" name="file" class="file">
                                <label for="file"></label>
                            </div>
                        </div>
                        @endif
                        <div id="image-preview">
                            @if ($file)
                            <img width="100%" src="{{ $file->temporaryUrl() }}">
                            @endif
                            @if($action == 'update' && !$file)
                                @if($photoOrientation=='h')
                                <img id="updated-img" width="100%" src="{{url('storage/img/medium/' . $updatedPhotoName)}}">
                                @else
                                <img id="updated-img" height="400px" src="{{url('storage/img/medium/' . $updatedPhotoName)}}">
                                @endif
                            @endif    
                        </div>
                    </div>

                    <div class="modal-body-container">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        @error('file') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="mb-3">
                            <label for="photoTitle" class="col-form-label">Tytuł*</label>
                            <div>
                                <textarea id="photoTitle" class="form-control" wire:model="photo.title"></textarea>
                                @error('photo.title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photoDesc" class="col-form-label">Opis*</label>
                            <div>
                                <textarea id="photoDesc" class="form-control" wire:model="photo.description"></textarea>
                                @error('photo.description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3 part-3">
                            <div class="album-wrapper">
                                <label class="col-form-label">Album*</label>
                                <div>
                                    @foreach($albums as $album)
                                    <div class="form-check">
                                        <input class="form-check-input" wire:model="photo.album_id" name="album" required type="radio" id="album-{{$album->id}}" value="{{ $album->id }}">
                                        <label class="form-check-label" for="album-{{$album->id}}">
                                            {{ $album->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                    @error('photo.album_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="datetime-wrapper">
                                <label class="col-form-label" for="taken">Data i godzina</label>
                                <div class="inputs-wrapper">
                                    @if($action=='create')
                                    <input type="date" class="form-control" {{ $file ? ' ' : 'disabled' }} wire:model="date" wire:change="changeDate" id="taken" value="{{$date}}">
                                    <input type="time" class="form-control" {{ $file ? ' ' : 'disabled' }} wire:model="time" wire:change="changeDate" id="time" value="{{$time}}">
                                    @else
                                    <input type="date" class="form-control" wire:model="date" wire:change="changeDate" id="taken" value="{{$date}}">
                                    <input type="time" class="form-control" wire:model="time" wire:change="changeDate" id="time" value="{{$time}}">
                                    @endif
                                </div>
                                @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('time') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="time-zone-wrapper">
                                    <br>
                                    <label class="col-form-label" for="">Strefa czasowa</label>
                                    @if($action=='create')
                                    <select class="form-control" wire:model="timeZone" wire:change="changeDate" {{ $file ? ' ' : 'disabled' }}>
                                        <!-- <option value="Europe/Warsaw" selected>Europe/Warsaw</option> -->
                                        <option value="UTC" selected>UTC</option>
                                        @foreach($timeZones as $zone)
                                        <option value="{{ $zone }}" required>{{ $zone }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <select class="form-control" wire:model="timeZone" wire:change="changeDate">
                                        <option value="UTC" selected>UTC</option>
                                        @foreach($timeZones as $zone)
                                        <option value="{{ $zone }}" required>{{ $zone }}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                    @error('timeZone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="quality-wrapper">
                                <label class="col-form-label" for="quality">Jakość:</label>
                                <input type="number" {{ $file ? ' ' : 'disabled' }} class="form-control" wire:model="quality" id="quality" min="0" max="100" step="1" value="{{$quality}}">
                                @error('quality') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="photoLabels" class="col-form-label">Etykiety</label>
                            <div class="labels-wrapper">
                                @foreach($labels as $index => $label)
                                <div class="form-check" wire:key="{{ $loop->index }}">
                                    <input class="form-check-input" wire:model="photo_labels.{{ $label->id }}" type="checkbox" id="label-{{ $label->id }}" value="{{ $label->id }}">
                                    <label class="form-check-label" for="label-{{ $label->id }}">
                                    {{ $label->name }}
                                    </label>
                                </div>
                                @endforeach
                                @error('photo_labels') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div>
                    @if($action=='update')
                    <div class="file-input">
                        <input type="file" wire:model="file" id="file" accept="image/*" name="file" class="file">
                        <label for="file">Zmień plik</label>
                    </div>
                    @endif
                    </div>
                    <div>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" wire:click="{{ $action == 'create' ? 'create' : 'update' }}" class="btn btn-primary">Zapisz</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>