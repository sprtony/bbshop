<div class="grid grid-cols-4 gap-4 md:grid-cols-4">


    {{-- listado de filtros --}}
    <div class="top-32 col-span-4 self-start sm:sticky md:col-span-1">

        {{-- filtro de categorias --}}
        @foreach ($categories as $cat)
            <div class="my-2" x-data="{ open: false }">
                @if ($cat->children->count())
                    <div
                        class="font-bold text-xs lg:text-sm text-[#525553] bg-[#dcdcdc] uppercase p-3 rounded-md flex justify-between items-center [&>span]:cursor-pointer">
                        <a
                            href="{{ route('productOrCategory.index', ['fallbackPlaceholder' => $cat->slug]) }}">{{ $cat->name }}</a>
                        <span @click="open = !open" :class="open ? '-rotate-180' : ''"
                            class="transition-transform duration-500">
                            <x-heroicon-s-chevron-down class="h-5" />
                        </span>
                    </div>
                @else
                    <a class="font-bold text-xs lg:text-sm text-[#525553] bg-[#dcdcdc] uppercase p-3 rounded-md flex justify-between items-center"
                        href="{{ route('productOrCategory.index', ['fallbackPlaceholder' => $cat->slug]) }}">{{ $cat->name }}</a>
                @endif

                @if ($cat->children->count())
                    <div x-cloak class="overflow-hidden mt-3 max-h-0 transition-all duration-700"
                        x-ref="category{{ $cat->id }}"
                        :style="open ? 'max-height: ' + $refs.category{{ $cat->id }}.scrollHeight + 'px' : ''">
                        <div class="p-3 bg-white rounded-md">
                            @foreach ($cat->children as $subcategory)
                                <a href="{{ route('productOrCategory.index', ['fallbackPlaceholder' => $subcategory->slug]) }}"
                                    class="text-[#939393] flex justify-start gap-1 items-center cursor-pointer">
                                    <span>
                                        @if ($category && $subcategory->id == $category->id)
                                            <x-fas-square class="h-3" />
                                        @else
                                            <x-far-square class="h-3" />
                                        @endif
                                    </span>
                                    <span class="text-sm capitalize">
                                        {{ $subcategory->name }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach



        {{-- filtro de attributos --}}
        @if ($brands->count())
            <x-catalog::filters.accordion>
                <x-slot:title>Marcas</x-slot:title>

                <template x-for="brand in brands" x-key="brand.id">
                    <span class="text-[#939393] flex justify-start gap-1 items-center cursor-pointer"
                        @click="$wire.toggleSelectedBrands(brand.slug)">
                        <span>
                            <template x-if="selectedBrands.includes(brand.slug)">
                                <x-fas-square class="h-3" />
                            </template>
                            <template x-if="!selectedBrands.includes(brand.slug)">
                                <x-far-square class="h-3" />
                            </template>
                        </span>
                        <span class="text-sm capitalize" x-text="brand.name"></span>
                    </span>
                </template>
            </x-catalog::filters.accordion>
        @endif

        <div wire:click="togglePromotion()"
            class="my-2 font-bold text-xs lg:text-sm text-[#525553] bg-[#dcdcdc] uppercase p-3 rounded-md flex items-center cursor-pointer">
            <span>
                @if ($promotion)
                    <x-fas-square class="h-5" />
                @else
                    <x-far-square class="h-5" />
                @endif
            </span>
            <span class="ml-2">Promoción</span>
        </div>
    </div>



    {{-- Listado de productos --}}
    <div class="grid grid-cols-2 col-span-4 gap-1 md:grid-cols-3 md:col-span-3 md:gap-4 lg:grid-cols-4">
        @forelse($products as $product)
            <x-catalog::cards.product :product="$product" />
        @empty
            <div class="flex col-span-full justify-center pt-5">
                <p class="text-xl font-bold text-secundario">No hay productos disponibles
                <p>
            </div>
        @endforelse

        {{-- infint loader trigger and spinner --}}
        <div x-data="{ shown: false }" x-intersect="$wire.loadMore();shown = true" x-intersect:leave="shown = false"
            class="flex col-span-full justify-center">
            <div class="h-5"></div>
            <div x-show="shown" x-transition>
                <x-vaadin-spinner-third class="h-20 text-black animate-spin aspect-square" />
            </div>
        </div>
    </div>



</div>
