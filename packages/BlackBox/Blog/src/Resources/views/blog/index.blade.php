@extends('layout.master')

@section('content')
    <section id="blog">
        @include('pages.blog.sections.banner')

        <div class="h-10"></div>
        <div class="container p-2">
            @livewire('blog::listado', ['category' => $category])
        </div>
        <div class="h-10"></div>

        <div class="bg-[url('../images/blog/parallax.webp')] bg-no-repeat bg-fixed bg-center">
            <div class="container grid md:grid-cols-2 xl:grid-cols-12">
                <div class="xl:col-span-5">
                    <img src="{{ asset('images/blog/img_parallax.webp') }}" alt="{{ setting('seo.title') }}">
                </div>
                <div class="xl:col-span-7 flex flex-col justify-center items-center md:items-start font-circularSTD ">
                    <h1 class="text-center md:text-left text-5xl text-primario font-bold">
                        DISTRIBUIDOR AUTORIZADO <br>
                        DE MARCAS LÍDERES
                    </h1>
                    <div class="h-4"></div>
                    <a href="{{ route('about') }}" class="text-white bg-black rounded-[50px] px-8 py-1">Ver empresa</a>
                </div>
            </div>
            <div class="h-5"></div>
        </div>

    </section>
@endsection
