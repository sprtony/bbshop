<section id="banner" class="relative">
    <video class="w-full" autoplay muted loop playsinline>
        {{-- <source src="{{ core()->getConfigData('variables.general.settings.video_file') }}" type="video/mp4"> --}}
        <source src="{{ asset('videos/interlactea.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <div class="absolute bottom-10 pl-2 text-white md:bottom-16">
            <h1 class="text-lg md:text-3xl lg:text-5xl">SOLUCIONES</h1>
            <h1 class="text-lg font-bold md:text-3xl lg:text-5xl">Tecnológicas</h1>
            <div class="h-5"></div>
            <a href="{{ setting('general.banner_url') }}"
                class="flex items-center px-1 text-sm border-2 border-white border-solid lg:py-1 lg:px-3 lg:text-lg w-fit"><span>Conoce
                    más</span><x-heroicon-m-arrow-small-right class="h-7" /></a>
        </div>
    </div>

</section>
