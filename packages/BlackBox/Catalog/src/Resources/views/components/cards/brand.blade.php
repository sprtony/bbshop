<a href="{{ url('productos/?' . urldecode('marcas[0]=' . $brand->slug)) }}">
    <img src="{{ Storage::url($brand->icon) }}" alt="{{ $brand->name }}">
</a>
