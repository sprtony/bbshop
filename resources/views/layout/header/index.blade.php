<header class="sticky top-0 z-50">

    {{-- notificaciones --}}
    <div class="p-2 border border-t-0 border-r-0 border-l-0 border-b border-[#e5e7eb]">
        <div class="container flex justify-between items-center">
            <div>
                locales switcher
            </div>

            <p class="text-xs font-medium">
                Get UPTO 40% OFF on your 1st order <a href="{{ route('home') }}" class="underline">SHOP NOW</a>
            </p>

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
            <div class="flex gap-x-10 items-center grow basis-0">

                @include('layout.header.drawers.menu')

                <a href="{{ route('home') }}">
                    <img src="{{ setting('seo.logo') ? Storage::url(setting('seo.logo')) : Vite::asset('resources/images/layout/logo.webp') }}"
                        alt="{{ setting('seo.title') }}" class="max-h-10 max-h-11">
                </a>

                <div
                    class="hidden xl:flex [&>a]:uppercase [&>a]:text-sm [&>a:not(:first-child)]:ml-4 [&>a:not(:last-child)]:mr-4 [&>a]:font-circularSTD items-center">
                    @include('layout.header.sections.menu-links')
                </div>

            </div>


            {{-- Navegacion Derecha --}}
            <div class="flex justify-end grow basis-0">
                search
                cart
                login
            </div>

        </div>
    </div>

</header>
