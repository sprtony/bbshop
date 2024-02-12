@extends('layout.master')

@section('content')
    <section id="products">
        <div class="h-10"></div>
        <div class="container p-2">
            @livewire('catalog::listado', ['category' => $category])
        </div>
        <div class="h-10"></div>
    </section>
@endsection
