@props([
    'title' => 'Inicio',
    'route' => route('home'),
])

<a href="{{ $route }}"
    {{ $attributes->merge([
        'class' =>
            'flex items-start flex-col uppercase' . ' ' . (request()->fullUrl() == $route ? 'font-bold' : 'font-medium'),
    ]) }}>
    {{-- auxilar para evitar el shift --}}
    <span class="overflow-hidden invisible h-0 font-bold">{{ $title }}</span>

    {{ $title }}
</a>
