<div class="relative">
    <a href="{{ route('postOrCategory.index', ['slug' => $post->slug]) }}">
        <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
        <div class="md:absolute bg-primario text-white text-sm px-4 py-1 md:top-6">
            {{ $post->date->isoFormat('D [de] MMMM [de] Y') }}</div>
    </a>
    <div class="h-4"></div>
    <div class="flex justify-center gap-2 flex-wrap">
        @foreach ($post->tags as $tag)
            <span class="bg-primario rounded-[50px] text-white text-sm px-6 py-1">{{ $tag }}</span>
        @endforeach
    </div>
    <div class="h-4"></div>
    <a href="{{ route('postOrCategory.index', ['slug' => $post->slug]) }}"
        class="text-[#226f4c] text-lg capitalize">{{ $post->title }}</a>
    <div class="h-2"></div>
    <a href="{{ route('postOrCategory.index', ['slug' => $post->slug]) }}" class="text-[#636363] text-xs">
        <span>{{ $post->description }}</span>
        <br>
        <span class="text-black text-base">Leer más</span>
    </a>
</div>
