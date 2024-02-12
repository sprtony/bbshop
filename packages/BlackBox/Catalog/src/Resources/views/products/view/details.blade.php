<h1 class="text-3xl text-primario font-bold capitalize">{{ $product->name }}</h1>
<p class="text-xl text-[#979696] font-kanit font-normal">Capacidad: {{ $product->capacity }}</p>
{{-- <p class="text-sm text-[#979696] font-kanit font-normal">Modelo: {{ $product->sku }}</p> --}}

@if ($product->brand)
    <div class="h-3"></div>
    <x-catalog::brand-card :brand="$product->brand" />
@endif

<div class="h-3"></div>

@if ($product->datasheet)
    <div class="h-[1px] bg-[#979696]"></div>
    <div class="h-3"></div>

    <div class="flex gap-2 font-poppins font-bold uppercase text-white [&>a]:bg-primario [&>a]:py-2">
        <a href="{{ Storage::url($product->datasheet) }}" class="px-4 hover:bg-secundario hvr-pulse-grow"
            target="_blank">DESCARGAR
            FICHA TÉCNICA</a>
    </div>
@endif
<div class="h-3"></div>
<div class="h-[1px] bg-[#979696]"></div>

<div class="h-3"></div>
<div class="text-sm text-[#979696] font-kanit font-normal">{!! $product->description !!}</div>
<div class="h-3"></div>
@livewire('catalog::cotizador', ['product_name' => $product->name])
