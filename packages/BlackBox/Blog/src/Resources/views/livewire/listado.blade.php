<section class="grid grid-cols-2 lg:grid-cols-3 gap-2">
    @forelse($posts as $post)
        <x-blog::post-card :post="$post" />
    @empty
        <div class="flex justify-center pt-5 col-span-full">
            <p class="text-xl text-secundario font-bold">
                No hay posts disponibles
            <p>
        </div>
    @endforelse

    @if ($posts->hasMorePages())
        <div x-data="{ shown: false }" x-intersect="$wire.loadMore();shown = true" class="col-span-full flex justify-center">
            <div class="h-5"></div>
            <div x-show="shown" x-transition>
                <x-vaadin-spinner-third class="animate-spin h-20 aspect-square text-primario" />
            </div>
        </div>
    @endif
</section>
