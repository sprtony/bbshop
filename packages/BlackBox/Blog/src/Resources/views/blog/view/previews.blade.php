<div>
    @foreach ($posts as $p)
        <x-blog::post-card :post="$p" />
        <div class="h-5"></div>
    @endforeach
</div>
