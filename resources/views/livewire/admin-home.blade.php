<div>

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
                        <button class="btn btn-dark text-uppercase" wire:click="update">Zapisz</button>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="home-metadata-modal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Strona główna</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bcg">
            <div class="mb-3">
                <label for="pageTitle" class="col-form-label">Tytuł strony*</label>
                <input type="text" wire:model="page.title" class="form-control" id="pageTitle" required>
                @error('page.title') <span class="text-danger" id="name-error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="pageDesc" class="col-form-label">Opis strony*</label>
                <div>
                <textarea id="pageDesc" class="form-control" wire:model="page.description"></textarea>
                @error('page.description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div> 
        </div>
          <div class="modal-footer">
              <div></div>
              <div>
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Anuluj</button>
                    <button type="submit" wire:click="update" class="btn btn-primary">Zapisz</button>
                </div>
          </div>
    </div>
  </div>
</div>
</div>
