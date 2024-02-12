<div class="flex items-center flex-col py-5">
    <a href="{{ route('productOrCategory.index', ['fallbackPlaceholder' => $category->slug]) }}"
        class="relative w-36 lg:w-52 aspect-square flex justify-center items-center text-secundario hover:text-white group">
        <div
            class="w-36 lg:w-52 aspect-square border-current border-4 border-solid rounded-full
            transition duration-1000 ease-in-out group-hover:border-t-primario group-hover:rotate-[360deg]">
        </div>
        @if ($category->icon)
            {!! generateSVG($category->icon, 'fill-current h-20 lg:h-28 absolute transition duration-1000 ease-in-out') !!}
        @endif
    </a>
    <a class="bg-secundario text-center w-36 lg:w-52 mt-3 flex justify-center py-1 text-sm lg:text-lg text-white font-circularSTD uppercase font-semibold"
        href="{{ route('productOrCategory.index', ['fallbackPlaceholder' => $category->slug]) }}">{{ $category->name }}</a>
</div>
