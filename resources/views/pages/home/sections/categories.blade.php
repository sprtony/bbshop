<section id="categorias" class="bg-primario">
    <div class="h-10"></div>
    <h1 class="text-2xl md:text-3xl text-white font-circularSTD text-center">¿Qué estas buscando?</h1>
    <div class="h-10"></div>
    {{-- <div class="container grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4"> --}}
    <div class="container flex flex-wrap justify-center">
        @foreach ($categories as $category)
            <div class="w-1/2 sm:w-1/3 lg:w-1/4">
                <x-catalog::category-card :category="$category" />
            </div>
        @endforeach
    </div>
    <div class="h-10"></div>
</section>
