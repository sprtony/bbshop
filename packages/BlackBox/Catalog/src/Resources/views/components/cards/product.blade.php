<div class="max-w-[300px]">
    <a href="{{ $product->url }}">
        <div class="flex justify-center items-center h-64">
            {{-- <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}" class="max-h-64"> --}}
            {{ json_encode($product->thumbnail) }}
        </div>
        <div class="flex flex-col items-center py-2 text-white bg-secundario font-circularSTD">
            <span class="font-bold text-center lg:text-lg">{{ $product->name }}</span>
        </div>
    </a>

</div>
