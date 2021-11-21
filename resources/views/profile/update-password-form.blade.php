<x-jet-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Zmiana Hasła') }}
    </x-slot>

    <x-slot name="description">
        {{ __('.') }}
    </x-slot>

    <x-slot name="form">

    <x-jet-action-message on="saved">
            {{ __('Zapisano zmiany!') }}
        </x-jet-action-message>

        <div class="w-md-75">
            <div class="mb-3">
                <x-jet-label for="current_password" value="{{ __('Aktualne Hasło') }}" />
                <x-jet-input id="current_password" type="password" class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-jet-input-error for="current_password" />
            </div>

            <div class="mb-3">
                <x-jet-label for="password" value="{{ __('Nowe Hasło') }}" />
                <x-jet-input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.password" autocomplete="new-password" />
                <x-jet-input-error for="password" />
            </div>

            <div class="mb-3">
                <x-jet-label for="password_confirmation" value="{{ __('Potwierdź Nowe Hasło') }}" />
                <x-jet-input id="password_confirmation" type="password" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                             wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-jet-input-error for="password_confirmation" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-button>
            {{ __('Zapisz') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
