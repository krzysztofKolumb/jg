<div class="albums">
    <div class="options-container">
        <div class="group-1 flex-wrapper">
            <div>
                <button type="button" class="btn btn-primary btn-new" wire:click="openModal">Dodaj album</button>
            </div>
            <div id="total-wrapper">
                <h6>Liczba albumów</h6>
                <p class="total">{{ count($albums) }}</p>
            </div>
        </div>
    </div>
    @foreach($albums as $index => $album)
    <x-jet-section-border />
    <div wire:key="album-{{ $album->id }}" class="row">
        <div class="col-md-4">
            <div class="px-4 px-sm-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="h5">{{ ucfirst($album->name) }}</h3>
                        <p class="mt-1 text-muted">Liczba zdjęć: {{ $album->photos()->count() }}</p>
                    </div>
                    <div></div>
                </div>
            </div>    
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="w-md-75">
                            <div class="mb-3">
                                <label for="albumName-{{$index}}">Nazwa albumu</label>
                                <input type="text" wire:model.defer="albums.{{ $index }}.name" class="form-control" id="albumName-{{$index}}" required>
                                @error('albums.{{$index}}.name') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pageTitle-{{$index}}">Tytuł strony</label>
                                <input type="text" wire:model.defer="albums.{{ $index }}.title" class="form-control" id="pageTitle-{{$index}}" required>
                                @error('albums.{{$index}}.title') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pageDesc-{{$index}}">Opis strony</label>
                                <div>
                                    <textarea id="pageDesc-{{$index}}" class="form-control" wire:model.defer="albums.{{$index}}.description"></textarea>
                                    @error('albums.{{$index}}.description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3 img-sort-wrapper">
                                <label>Sortowanie</label>
                                <select class="form-control" wire:model.defer="albums.{{$index}}.img_order">
                                    <option value="1" required>Data dodania</option>
                                    <option value="2" required>Data wykonania</option>
                                </select>
                                @error('albums.{{$index}}.img_order') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> 
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-dark text-uppercase" wire:click="save( {{$index}})">Zapisz</button>
                    <button class="btn btn-dark text-uppercase" wire:click="selectedItem( {{$album->id}} , 'delete' )">Usuń</button>

                    <!-- <button type="button" wire:click="save( {{$index}})" title="Zapisz">
                        <img width="30px" src="{{url('storage/img/icon-edit-c.png')}}" >
                  </button> -->
                  <!-- <button type="button" wire:click="selectedItem( {{$album->id}} , 'delete' )" title="Usuń">
                        <img width="25px" src="{{url('storage/img/icon-trash-d.png')}}" >
                    </button> -->
                        <!-- <button class="btn btn-dark text-uppercase" wire:click="save({{$index}})">Zapisz</button>
                        <button class="btn btn-dark text-uppercase" wire:click="selectedItem( {{$album->id}} , 'delete' )">Usuń</button> -->
                    </div>
            </div>
        </div>
    </div>

    @endforeach

    <br><br><br>

    <div class="modal fade" wire:ignore.self id="album-modal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Album</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bcg">
            <div class="mb-3">
                <label for="albumName" class="col-form-label">Nazwa*</label>
                <input type="text" wire:model="album.name" class="form-control" id="albumName" required>
                @error('album.name') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                @error('unique') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="albumTitle" class="col-form-label">Tytuł strony*</label>
                <input type="text" wire:model="album.title" class="form-control" id="albumTitle" required>
                @error('album.title') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="albumDesc" class="col-form-label">Opis strony*</label>
                <div>
                <textarea id="albumDesc" class="form-control" wire:model="album.description"></textarea>
                @error('album.description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="albumImgOrder" class="col-form-label">Sortowanie według</label>
                <select class="form-control" wire:model="album.img_order">
                    <option value="1" required>Data dodania</option>
                    <option value="2" required>Data wykonania</option>
                </select>
                @error('album.img_order') <span class="text-danger">{{ $message }}</span> @enderror
            </div> 
        </div>
        <div class="modal-footer">
            <div></div>
            <div>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                <button type="submit" wire:click="{{ $action == 'create' ? 'create' : 'update' }}" class="btn btn-primary">Zapisz</button>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" wire:ignore.self id="album-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($selected)
                    @if($canDelete==false)
                    <h5>W albumie są zdjęcia. Nie możesz go usunąć.</h5>
                    @else
                    <h5>Czy na pewno chcesz trwale usunąć album {{$selected}}?</h5>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <div></div>
                <div>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                @if($canDelete==true)
                <button type="submit" wire:click="delete" class="btn btn-primary">Usuń</button>
                @else
                <button type="submit" wire:click="delete" disabled class="btn btn-primary">Usuń</button>
                @endif
                </div>
            </div>
            </div>
        </div>
    </div>

</div>
