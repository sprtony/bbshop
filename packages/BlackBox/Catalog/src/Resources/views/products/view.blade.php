@extends('layout.master')

@section('content')
    <section id="products" class="bg-[#f7f7f7]">
        <div class="h-10"></div>
        <div class="container lg:grid grid-cols-12 gap-4 p-2">
            @include('pages.products.view.gallery')

            <div class="col-span-5 font-circularSTD">
                @include('pages.products.view.details')
            </div>
        </div>
        <div class="h-10"></div>
    </section>

    {{-- @include('pages.products.view.form') --}}
    @includeWhen($product->related_products->count(), 'pages.products.view.related')
@endsection

@push('after-css')
    <link rel="preload" href="{{ asset('plugins/glide/glide.core.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('plugins/glide/glide.theme.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link rel="stylesheet" href="{{ asset('plugins/glide/glide.core.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/glide/glide.theme.min.css') }}">
    </noscript>
@endpush


@push('scripts')
    <script src="{{ asset('plugins/glide/glide.min.js') }}" defer></script>
@endpush
