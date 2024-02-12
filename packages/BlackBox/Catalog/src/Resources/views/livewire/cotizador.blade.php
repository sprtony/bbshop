<form wire:submit="store" id="cotizar" class="sm:grid grid-cols-2 gap-2">

    <x-form.input label="Nombre completo" error="quote.name" required wire:model="quote.name" type="text" />

    <x-form.input label="Correo eléctronico" error="quote.email" required wire:model="quote.email" type="email" />

    <x-form.input label="Teléfono" error="quote.phone" wire:model="quote.phone" required type="tel" />

    <x-form.input label="Solución que le interesa" error="quote.solution" wire:model="quote.solution" required
        type="text" />

    <x-form.input label="Código postal" error="quote.postal_code" wire:model.live="quote.postal_code" required
        type="text" maxlength="5" />

    <x-form.input label="Estado" wire:model="quote.state" readonly type="text" />
    <x-form.input label="Ciudad" wire:model="quote.city" readonly type="text" />

    <x-form.text-area label="Comentarios" wire:model="quote.message" />

    <span class="flex justify-center items-center">
        <button type="sumbit" data-sitekey="{{ setting('general.captcha_public') }}" data-callback='handle'
            data-action='submit' wire:loading.attr="disabled"
            class="g-recaptcha hvr-pulse-grow font-poppins font-bold uppercase text-white bg-primario hover:bg-secundario py-2 px-8 flex">
            <span wire:loading.remove>COTIZAR</span>
            <span wire:loading>
                <x-vaadin-spinner-third class="animate-spin h-5 w-5 text-white" />
            </span>
        </button>
    </span>
</form>

@push('scripts')
    @if (setting('general.captcha_private') && setting('general.captcha_public'))
        {
        <script src="https://www.google.com/recaptcha/api.js?render={{ setting('general.captcha_public') }}"></script>
        <script>
            function handle(e) {
                grecaptcha.ready(function() {
                    grecaptcha.execute("{{ setting('general.captcha_public') }}", {
                            action: 'submit'
                        })
                        .then(function(token) {
                            @this.set('captcha', token);
                        });
                })
            }
        </script>
    @endif
@endpush
