<section id="destacados" class="bg-gray-100">
    <div class="h-10"></div>
    <h1 class="text-primario text-center text-xl lg:text-4xl font-circularSTD font-semibold">PRODUCTOS DESTACADOS</h1>
    <div class="h-10"></div>

    <div class="container">
        <div class="glide featured-products">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach ($featuredProducts as $product)
                        <li class="glide__slide flex justify-center">
                            <x-catalog::product-card :product="$product" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="h-10"></div>
</section>

@push('scripts')
    <script>
        window.addEventListener("load", (event) => {
            new Glide('.featured-products', {
                type: "{{ $featuredProducts->count() >= 4 ? 'carousel' : 'slider' }}",
                focusAt: 'center',
                startAt: 0,
                gap: 20,
                perView: 4,
                autoplay: 2000,
                breakpoints: {
                    1024: {
                        type: "{{ $featuredProducts->count() >= 3 ? 'carousel' : 'slider' }}",
                        perView: 3
                    },
                    768: {
                        type: "{{ $featuredProducts->count() >= 2 ? 'carousel' : 'slider' }}",
                        perView: 2
                    }
                }
            }).mount();
        });
    </script>
@endpush
