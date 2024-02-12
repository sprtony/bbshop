<div class="text-primario font-semibold font-barlow">
    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
    <h1 class="text-4xl">{{ $post->title }}</h1>
    <h2 class="text-3xl">{{ $post->subtitle }}</h2>
    <div class="h-5"></div>
    <span class="text-lg text-[#464646] font-medium">{{ $post->date->isoFormat('D [de] MMMM [de] Y') }}</span>
</div>
