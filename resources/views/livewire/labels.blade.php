<div>
<div class="options-container">
        <div class="group-1 flex-wrapper">
            <div>
                <button type="button" class="btn btn-primary btn-new" wire:click="openModal">Dodaj etykietę</button>
            </div>
            <div id="total-wrapper">
                <h6>Liczba etykiet</h6>
                <p class="total">{{ count($labels) }}</p>
            </div>
        </div>
    </div>
    @foreach($labels as $index => $label)
    <x-jet-section-border />
    <div wire:key="label-{{ $label->id }}" class="row">
        <div class="col-md-4">
            <div class="px-4 px-sm-0">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="h5">{{ ucfirst($label->name) }}</h3>
                        <p class="mt-1 text-muted">Liczba zdjęć: {{ $label->photos()->count() }}</p>
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
                            <label for="labelName-{{$index}}">Nazwa etykiety</label>
                            <input type="text" wire:model.defer="labels.{{ $index }}.name" class="form-control" id="labelName-{{$index}}" required>
                            @error('labels.{{$index}}.name') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-dark text-uppercase" wire:click="save( {{$index}})">Zapisz</button>
                    <button class="btn btn-dark text-uppercase" wire:click="selectedItem( {{$label->id}} , 'delete' )">Usuń</button>
                </div>
            </div>
        </div>
    </div>

    @endforeach

    <br><br><br>

    <div class="modal fade" wire:ignore.self id="label-modal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Etykieta</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bcg">
            <div class="mb-3">
                <label for="labelName" class="col-form-label">Nazwa*</label>
                <input type="text" wire:model="label.name" class="form-control" id="labelName" required>
                @error('label.name') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
                @error('unique') <span class="text-danger">{{ $message }}</span> @enderror
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

<div class="modal fade" wire:ignore.self id="label-delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($selected)
                    <h5>Czy na pewno chcesz trwale usunąć etykietę {{$selected}}?</h5>
                @endif
            </div>
            <div class="modal-footer">
                <div></div>
                <div>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" wire:click="delete" class="btn btn-primary">Usuń</button>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
