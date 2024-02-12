<header class="sticky top-0 z-50">

    {{-- notificaciones --}}
    <div class="p-2 text-white bg-black">
        <div class="container flex justify-end items-center">
            @if (is_array($phone = setting('social.phone')) && isset(current($phone)->data->number))
                <a href="tel:{{ current($phone)->data->number ?? '' }}" class="flex items-center">
                    <x-heroicon-s-phone class="mr-3 h-4" />
                    <span class="mr-2 text-base font-semibold uppercase">{{ current($phone)->data->text ?? '' }}</span>
                </a>
            @endif

            <div class="flex">
                @if (setting('social.social_networks'))
                    @foreach (setting('social.social_networks') as $sn)
                        <a href="{{ $sn->url }}" target="_blank"
                            class="flex justify-center items-center ml-3 h-5 bg-white rounded-full first:ml-8 aspect-square">
                            @svg($sn->icon, 'h-4 text-primario')
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- menu --}}
    <div class="bg-white">
        <div class="container flex justify-between p-2">

            {{-- Navegacion Izquierda --}}
            <div class="flex gap-x-1.5 items-center grow basis-0">

                @include('layout.header.drawers.menu')

                <a href="{{ route('home') }}">
                    <img src="{{ Storage::url(setting('seo.logo')) }}" alt="{{ setting('seo.title') }}"
                        class="max-h-10 xl:max-h-max">
                </a>
            </div>


            {{-- Navegacion Derecha --}}
            <div class="flex justify-end grow basis-0">
                <div
                    class="hidden xl:flex [&>a]:uppercase [&>a]:text-sm [&>a:not(:first-child)]:ml-4 [&>a:not(:last-child)]:mr-4 [&>a]:font-circularSTD items-center">
                    @include('layout.header.sections.menu-links')
                </div>
            </div>

        </div>
    </div>

</header>
