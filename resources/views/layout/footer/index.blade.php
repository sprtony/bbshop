<footer class="py-5 bg-black">
    <div
        class="container grid grid-cols-2 grid-flow-row auto-rows-max px-2 text-xs text-white lg:grid-cols-12 lg:grid-rows-none lg:text-sm">
        <div class="flex flex-col justify-center py-3 lg:col-span-2 lg:col-start-3 lg:h-auto h-fit">
            <span>Dirección:</span>
            <address class="not-italic">
                Prolongación Álvaro Obregon
                #252 col. Centro C.P. 36100
                Silao, Guanajuato México.
            </address>
        </div>
        <div class="flex col-span-2 col-start-1 row-start-1 justify-center items-center lg:col-start-6">
            <img src="{{ Storage::url(setting('seo.logo_footer')) }}" alt="">
        </div>
        <div
            class="flex flex-col justify-center items-end py-3 lg:col-span-2 lg:col-start-9 lg:items-start lg:h-auto h-fit">
            <span class="block">Contáctanos</span>
            @if (is_array($phone = setting('social.phone')))
                <a href="tel:{{ current($phone)->data->number ?? '' }}"
                    class="block">{{ current($phone)->data->text ?? '' }}</a>
                <div class="h-5"></div>
            @endif
            <a href="mailto:{{ setting('email.email') }}" class="block">{{ setting('email.email') }}</a>
        </div>
    </div>
</footer>
