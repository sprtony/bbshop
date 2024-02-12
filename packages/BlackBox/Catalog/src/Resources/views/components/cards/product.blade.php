<div class="max-w-[300px]">
    <a href="{{ route('productOrCategory.index', ['fallbackPlaceholder' => $product->slug]) }}">
        <div class="h-64 flex justify-center items-center bg-white">
            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="max-h-64">
        </div>
        <div class="bg-secundario text-white flex flex-col items-center font-circularSTD py-2">
            <span class="font-bold lg:text-lg text-center">{{ $product->name }}</span>
            @if ($product->capacity)
                <span class="text-sm lg:text-base text-center">Capacidad: {{ $product->capacity }}</span>
            @endif
            @if ($product->brand)
                <span class="text-sm lg:text-base text-center">Marca: {{ $product->brand->name }}</span>
            @endif
        </div>
    </a>

</div>
