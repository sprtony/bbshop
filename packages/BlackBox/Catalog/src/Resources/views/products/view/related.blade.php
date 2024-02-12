<section id="relacionados">
    <div class="h-10"></div>
    <h1 class="text-primario text-center text-xl lg:text-2xl font-circularSTD font-semibold">PRODUCTOS RELACIONADOS</h1>
    <div class="h-10"></div>

    <div class="container">
        <div class="glide related-products">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach ($product->related_products as $related)
                        <li class="glide__slide flex justify-center">
                            <x-catalog::product-card :product="$related" />
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
            new Glide('.related-products', {
                type: "{{ $product->related_products->count() >= 4 ? 'carousel' : 'slider' }}",
                focusAt: 'center',
                startAt: 0,
                gap: 20,
                perView: 4,
                autoplay: 2000,
                breakpoints: {
                    1024: {
                        type: "{{ $product->related_products->count() >= 3 ? 'carousel' : 'slider' }}",
                        perView: 3
                    },
                    768: {
                        type: "{{ $product->related_products->count() >= 2 ? 'carousel' : 'slider' }}",
                        perView: 2
                    }
                }
            }).mount();
        });
    </script>
@endpush
