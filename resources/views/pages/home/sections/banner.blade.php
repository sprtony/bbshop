<section id="banner" class="relative">
    <video class="w-full" autoplay muted loop playsinline>
        {{-- <source src="{{ core()->getConfigData('variables.general.settings.video_file') }}" type="video/mp4"> --}}
        <source src="{{ asset('videos/interlactea.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="container">
        <div class="absolute bottom-10 md:bottom-16 text-white pl-2">
            <h1 class="font-circularSTD text-lg md:text-3xl lg:text-5xl">SOLUCIONES</h1>
            <h1 class="font-circularSTD text-lg md:text-3xl lg:text-5xl font-bold">Tecnológicas</h1>
            <div class="h-5"></div>
            <a href="{{ setting('general.banner_url') }}"
                class="border-white border-solid px-1 lg:px-3 lg:py-1 border-2 font-redHat text-sm lg:text-lg flex w-fit items-center"><span>Conoce
                    más</span><x-heroicon-m-arrow-small-right class="h-7" /></a>
        </div>
    </div>

</section>
