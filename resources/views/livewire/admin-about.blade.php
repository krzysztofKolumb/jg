<div class="admin-about">
<div class="row">
        <div class="col-md-4">
            <div class="px-4 px-sm-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="h5">Metadane</h3>
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
                                <label for="pageTitle">Tytuł strony</label>
                                <input type="text" wire:model="page.title" class="form-control" id="pageTitle" required>
                                @error('page.title') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pageDesc">Opis strony</label>
                                <div>
                                    <textarea id="pageDesc" class="form-control" wire:model="page.description"></textarea>
                                    @error('page.description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button class="btn btn-dark text-uppercase" wire:click="update('metadata')">Zapisz</button>
                    </div>
            </div>
        </div>
    </div>

    <x-jet-section-border />

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 px-sm-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="h5">Zdjęcie</h3>
                        <p class="mt-1 text-muted"></p>
                    </div>
                    <div></div>
                </div>
            </div>    
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="w-md-75">
                            <div class="admin-img-wrapper">
                                @if($page->photo)
                                <img width="200px" src="{{url('storage/img/o-mnie/' . $page->photo)}}" >
                                @else
                                <p>Brak zdjęcia</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        @if($page->photo)
                        <button class="btn btn-dark text-uppercase" wire:click="openModal('photo-delete')">Usuń</button>
                        @else
                        <button class="btn btn-dark text-uppercase" wire:click="openModal('photo')">Dodaj</button>
                        @endif
                    </div>
            </div>
        </div>
    </div>

    <x-jet-section-border />

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 px-sm-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="h5">Opis</h3>
                        <p class="mt-1 text-muted">
                        </p>
                    </div>
                    <div></div>
                </div>
            </div>    
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="w-md-75">
                            <div class="desc-tiny">
                            {!! $page->content !!}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button wire:click="openModal('content')" class="btn btn-dark text-uppercase">Edytuj</button>
                    </div>
            </div>
        </div>
    </div>

    <x-jet-section-border />

<div class="row">
    <div class="col-md-4">
        <div class="px-4 px-sm-0">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="h5">Dane kontaktowe</h3>
                    <p class="mt-1 text-muted"></p>
                </div>
            </div>
        </div>    
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
                <div class="card-body">
                    <div class="w-md-75">
                        <div class="mb-3">
                        <label for="pagePhone">Telefon</label>
                    <input type="text" wire:model="page.phone" class="form-control" id="pagePhone">
                    @error('page.phone') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                        <label for="pageEmail">E-mail</label>
                    <div>
                    <input type="text" wire:model="page.email" class="form-control" id="pageEmail">
                    @error('page.email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-dark text-uppercase" wire:click="update('contact')">Zapisz</button>
                </div>
        </div>
    </div>
</div>
<br><br><br>

<div class="modal fade" wire:ignore.self id="about-photo-modal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Zdjęcie</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body flex bcg">
        <div wire:loading wire:target="file" wire:ignore.self>
            <div id="spinner-container">
                <div class="lds-spinner">
                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                </div>
            </div>
        </div>
        @if(!$file && $action=='create')
            <div class="icon-camera-cont">
                <div class="photo-input">
                    <input type="file" wire:model="file" id="file" accept="image/*" name="file" class="file">
                    <label for="file"></label>
                </div>
            </div>
            @endif
                <div id="img-container">
                    @if ($file)
                    <div>
                        <img width="40%" src="{{ $file->temporaryUrl() }}">
                    </div><br>
                    <div>
                        <label for="photoName">Nazwa</label>
                        <div class="flex">
                            <input type="text" wire:model="photoName" class="form-control" id="photoName" required>
                            <span>.webp</span>
                        </div>
                        @error('photoName') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                    </div>
                    <br>
                    @endif  
                </div>
        </div>
            <div class="modal-footer">
                <div>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" {{ $file ? ' ' : 'disabled' }} wire:click="{{ $action == 'create' ? 'create' : 'update' }}" class="btn btn-primary">Zapisz</button>
                </div>
            </div>
    </div>
  </div>
</div>

    <div class="modal fade" wire:ignore.self id="about-contact-modal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Dane kontaktowe</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bcg">
                <div class="mb-3">
                    <label for="pagePhone" class="col-form-label">Telefon</label>
                    <input type="text" wire:model="page.phone" class="form-control" id="pagePhone">
                    @error('page.phone') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="pageEmail" class="col-form-label">E-mail</label>
                    <div>
                    <input type="text" wire:model="page.email" class="form-control" id="pageEmail">
                    @error('page.email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <div></div>
                <div>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" wire:click="update('contact')" class="btn btn-primary">Zapisz</button>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" wire:ignore.self id="about-content-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">O mnie</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <form id="editor-form">
                @csrf
                <div>
                    <label class="error-msg" id="textarea-tm-error" class="col-form-label"></label>
                    <textarea class="form-control editor" wire:model="content" id="textarea-editor" name="content" rows="8" cols="10">
                    </textarea>
                    @error('content') 
                    <div>{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer">
                    <div></div>
                    <div>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-primary">Zapisz</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" wire:ignore.self id="about-photo-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Czy na pewno chcesz trwale usunąć to zdjęcie?</h5>
                </div>
                <div class="modal-footer">
                    <div></div>
                    <div>
                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                        <button type="submit" wire:click="deletePhoto" class="btn btn-primary">Usuń</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
