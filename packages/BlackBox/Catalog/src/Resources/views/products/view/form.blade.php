<section id="form" class="bg-[#e0e0e0] scroll-mt-28">
    <div class="h-8"></div>
    <div class="container lg:grid grid-cols-12 gap-4 p-2">
        <div class="col-span-6 flex justify-center items-center pb-5">
            @if ($product->video)
                <iframe class="aspect-video w-[600px]" src="https://www.youtube.com/embed/{{ $product->yt }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            @endif
        </div>
        <div class="col-span-6">

            @livewire('catalog::cotizador', ['product_name' => $product->name])

        </div>
    </div>
    <div class="h-8"></div>
</section>
