@extends('layout.master')

@section('seo')
    <meta name="title" content="{{ $post->title }} | {{ implode(',', $post->tags) }}" />
    <meta name="DC.title" content="{{ $post->title }} | {{ implode(',', $post->tags) }}" />
    <meta property="og.title" content="{{ $post->title }} | {{ implode(',', $post->tags) }}" />
    <meta property="og.site_name" content="{{ $post->title }} | {{ implode(',', $post->tags) }}" />
    <meta name="twitter.site_name" content="{{ $post->title }} | {{ implode(',', $post->tags) }}" />
    <meta name="twitter.site" content="{{ $post->title }} | {{ implode(',', $post->tags) }}" />

    <meta name="description" content="{{ $post->description }}" />
    <meta property="og.description" content="{{ $post->description }}" />
    <meta name="twitter.description" content="{{ $post->description }}" />

    <meta name="keywords" content="{{ implode(',', $post->tags) }}" />

    <meta property="og:type" content="article">
    <meta name="twitter:card" content="summary">
    <meta name="robots" content="all">
    <meta name="copyright" content="Copyright (c) {{ date('Y') }}">

    <meta property="og:image" content="{{ Storage::url($post->image) }}">
    <meta name="twitter:image" content="{{ Storage::url($post->image) }}">
@endsection

@section('content')
    <section id="blog">
        @include('pages.blog.sections.banner')
        <div class="container md:grid grid-cols-4 gap-4 p-2">

            <div class="col-span-3">
                @include('pages.blog.view.banner')

                <div class="h-5"></div>

                <div class="md:flex gap-4 md:items-start">
                    @include('pages.blog.view.share')
                    <div class="[&>h2]:text-3xl text-[#464646]">{!! $post->content !!}</div>
                </div>
            </div>

            @include('pages.blog.view.previews')

        </div>
        <div class="h-5"></div>
    </section>
@endsection
