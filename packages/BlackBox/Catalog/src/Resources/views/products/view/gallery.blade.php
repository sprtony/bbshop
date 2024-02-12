<div class="col-span-7 flex justify-center items-center flex-col gap-4 pb-4" x-data="gallery">
    <figure class="relative overflow-hidden bg-center cursor-zoom-in group bg-no-repeat" @mousemove="zoom(event)"
        :style="`background-image: url(${current})`" x-cloak>
        <div
            class="w-full lg:w-[400px] aspect-square flex justify-center items-center bg-white group-hover:bg-transparent">
            <img :src="current" alt="{{ $product->name }}" class="max-h-[400px] block group-hover:opacity-0">
        </div>
    </figure>

    @if ($product->gallery)
        <div class="glide gallery" x-cloak>
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides [&>li]:bg-white">
                    <li class="glide__slide" @click="current = '{{ Storage::url($product->thumbnail) }}'">
                        <div class="flex justify-center w-full h-full">
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}"
                                class="max-h-40">
                        </div>
                    </li>
                    @foreach ($product->gallery as $image)
                        <li class="glide__slide" @click="current = '{{ Storage::url($image) }}'">
                            <div class="flex justify-center w-full h-full">
                                <img src="{{ Storage::url($image) }}" alt="{{ $product->name }}" class="max-h-40">
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if ($product->video)
        <iframe class="aspect-video w-full" src="https://www.youtube.com/embed/{{ $product->yt }}"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen></iframe>
    @endif

</div>

@push('scripts')
    <script>
        window.addEventListener("alpine:init", (event) => {
            Alpine.data('gallery', () => ({
                current: "{{ Storage::url($product->thumbnail) }}",
                zoom(e) {
                    var zoomer = e.currentTarget;
                    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
                    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
                    x = offsetX / zoomer.offsetWidth * 100
                    y = offsetY / zoomer.offsetHeight * 100
                    zoomer.style.backgroundPosition = x + '% ' + y + '%';
                }

            }))
        });

        @if ($product->gallery)
            window.addEventListener("load", (event) => {
                new Glide('.gallery', {
                    type: "carousel",
                    startAt: 0,
                    gap: 20,
                    perView: 3,
                    breakpoints: {
                        768: {
                            perView: 2
                        }
                    }
                }).mount();
            });
        @endif
    </script>
@endpush
