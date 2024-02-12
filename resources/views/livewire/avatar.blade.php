<div>
    avatar
    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit">
            Submit
        </button>
    </form>

    <x-filament-actions::modals />
</div>

@push('before-css')
    @filamentStyles
@endpush

@push('scripts')
    @filamentScripts
@endpush
