<section id="brands" class="bg-gray-200">
    <div class="h-10"></div>
    <h1 class="text-primario text-center text-xl lg:text-4xl font-circularSTD font-semibold">MARCAS LIDERES</h1>
    <div class="h-10"></div>

    <div class="glide brands">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                @foreach ($brands as $brand)
                    <li class="glide__slide flex justify-center">
                        <x-catalog::brand-card :brand="$brand" />
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="h-10"></div>
</section>

@push('scripts')
    <script>
        window.addEventListener("load", (event) => {
            new Glide('.brands', {
                type: "{{ $brands->count() >= 4 ? 'carousel' : 'slider' }}",
                focusAt: 'center',
                startAt: 0,
                gap: 20,
                perView: 7,
                autoplay: 2000,
                breakpoints: {
                    1024: {
                        type: "{{ $brands->count() >= 3 ? 'carousel' : 'slider' }}",
                        perView: 3
                    },
                    768: {
                        type: "{{ $brands->count() >= 2 ? 'carousel' : 'slider' }}",
                        perView: 2
                    }
                }
            }).mount();
        });
    </script>
@endpush
