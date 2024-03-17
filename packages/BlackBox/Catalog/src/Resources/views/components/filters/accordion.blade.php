<div class="my-2" x-data="{ open: false, brands: @js($brands), selectedBrands: @entangle('selectedBrands').live }" wire:ignore>
    <div class="font-bold text-sm text-[#525553] bg-[#dcdcdc] uppercase p-3 rounded-md [&>span]:cursor-pointer">
        <span @click="open = !open" class="flex justify-between items-center">

            {{ $title }}

            <span :class="open ? '-rotate-180' : ''" class="transition-transform duration-500">
                <x-heroicon-s-chevron-down class="h-5" />
            </span>
        </span>
    </div>

    <div x-cloak class="overflow-hidden mt-3 max-h-0 transition-all duration-700" x-ref="brands"
        :style="open ? 'max-height: ' + $refs.brands.scrollHeight + 'px' : ''" @key="open">
        <div class="p-3 bg-white rounded-md">
            {{ $slot }}
        </div>
    </div>
</div>
