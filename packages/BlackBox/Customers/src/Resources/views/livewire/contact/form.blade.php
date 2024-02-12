<form wire:submit="store" class="grid md:grid-cols-2 gap-4">

    <x-form.input label="Nombre completo" error="contactMessage.name" required wire:model="contactMessage.name" type="text" />

    <x-form.input label="Correo eléctronico" error="contactMessage.email" required wire:model="contactMessage.email" type="email" />

    <x-form.input label="Teléfono" error="contactMessage.phone" wire:model="contactMessage.phone" required type="tel" />

    <x-form.input label="Whatsapp" error="contactMessage.whatsapp" wire:model="contactMessage.whatsapp" required type="tel" />

    <x-form.input label="Dirección" error="contactMessage.street" wire:model="contactMessage.street" required type="text" />

    <x-form.input label="Código postal" error="contactMessage.postal_code" wire:model.live="contactMessage.postal_code" required
        type="text" maxlength="5" />

    <x-form.input label="Estado" wire:model="contactMessage.state" readonly type="text" />
    <x-form.input label="Ciudad" wire:model="contactMessage.city" readonly type="text" />

    <x-form.text-area label="Comentarios y/o sugerencias" wire:model="contactMessage.message" error="contactMessage.message" />

    {{-- <x-form.input label="Solución que le interesa" error="contactMessage.solution" wire:model="contacMessage.solution" required --}}
    {{--     type="text" /> --}}



    <span class="flex justify-center items-center">
        <button type="sumbit" data-sitekey="{{ setting('general.captcha_public') }}" data-callback='handle'
            data-action='submit' wire:loading.attr="disabled"
            class="g-recaptcha hvr-pulse-grow font-poppins font-bold uppercase text-white bg-primario hover:bg-secundario py-2 px-8 flex">
            <span wire:loading.remove>ENVIAR</span>
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
