<div class="grid grid-cols-4 md:grid-cols-4 gap-4">
    <div class="col-span-4 md:col-span-1 sm:sticky top-32 self-start">
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
                    <div x-cloak class="mt-3 overflow-hidden max-h-0 transition-all duration-700"
                        x-ref="category{{ $cat->id }}"
                        :style="open ? 'max-height: ' + $refs.category{{ $cat->id }}.scrollHeight + 'px' : ''">
                        <div class="bg-white p-3 rounded-md">
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
                                    <span class="text-sm capitalize ">
                                        {{ $subcategory->name }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach

        @if ($brands->count())
            <div class="my-2" x-data="{ open: false, brands: @js($brands), selectedBrands: @entangle('selectedBrands').live }" wire:ignore>
                <div
                    class="font-bold text-sm text-[#525553] bg-[#dcdcdc] uppercase p-3 rounded-md [&>span]:cursor-pointer">
                    <span @click="open = !open" class="flex justify-between items-center">
                        Marcas
                        <span :class="open ? '-rotate-180' : ''" class="transition-transform duration-500">
                            <x-heroicon-s-chevron-down class="h-5" />
                        </span>
                    </span>
                </div>

                <div x-cloak class="mt-3 overflow-hidden max-h-0 transition-all duration-700" x-ref="brands"
                    :style="open ? 'max-height: ' + $refs.brands.scrollHeight + 'px' : ''" @key="open">
                    <div class="bg-white p-3 rounded-md">
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
                    </div>
                </div>

            </div>
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

    <div class="col-span-4 md:col-span-3 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-1 md:gap-4">
        @forelse($products as $product)
            <x-catalog::product-card :product="$product" />
        @empty
            <div class="flex justify-center pt-5 col-span-full">
                <p class="text-xl text-secundario font-bold">No hay productos disponibles
                <p>
            </div>
        @endforelse
        @if ($products->hasMorePages())
            <div x-data="{ shown: false }" x-intersect="$wire.loadMore();shown = true"
                class="col-span-full flex justify-center">
                <div class="h-5"></div>
                <div x-show="shown" x-transition>
                    <x-vaadin-spinner-third class="animate-spin h-20 aspect-square text-primario" />
                </div>
            </div>
        @endif
    </div>
</div>
