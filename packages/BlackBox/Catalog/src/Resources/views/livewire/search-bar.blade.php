<div class="flex relative justify-center" wire:keydown.escape.window="$set('open', false)"
    wire:click.outside="$set('open', false)">

    <div class="flex bg-[#f5fcfd] w-full">
        <input type="text" placeholder="BUSCAR MAQUINARIA" wire:model.live="search" onfocus="this.placeholder=''"
            onblur="this.placeholder='BUSCAR MAQUINARIA'"
            class="border-0 h-8 grow bg-[#f5fcfd] placeholder:text-primario placeholder:text-xs placeholder:font-semibold placeholder:font-circularSTD focus:ring-transparent text-primario text-xs font-semibold font-circularSTD">
        <span class="flex justify-center items-center h-8 aspect-square">
            @if (!$open)
                <span>
                    <x-vaadin-search class="h-4 text-primario" />
                </span>
            @else
                <span wire:click="$set('open', false)" class="cursor-pointer">
                    <x-heroicon-o-x-mark class="h-4 text-primario" />
                </span>
            @endif
        </span>
    </div>

    @if ($open)
        <div
            class="absolute top-full p-2 bg-white border-2 divide-y w-[320px] divide-primario border-primario xl:w-[500px]">
            @forelse($results as $product)
                <a href="{{ route('productOrCategory.index', ['fallbackPlaceholder' => $product->slug]) }}"
                    class="flex justify-between items-center w-full hover:text-primario">
                    <div class="flex justify-center items-center h-16 aspect-square">
                        <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="max-h-16">
                    </div>
                    <span class="text-lg text-right">{{ $product->name }}</span>
                </a>
            @empty
                <span class="">Sin resultados</span>
            @endforelse

            @if (count($results))
                <a href="" class="flex justify-end items-center w-full h-16 text-lg hover:text-primario">
                    Ver todos los resultado
                    <x-heroicon-s-chevron-right class="h-5" />
                </a>
            @endif

        </div>
    @endif
</div>
