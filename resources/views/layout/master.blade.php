<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth js">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-language" content="{{ app()->getLocale() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url()->to('/') }}">

    <title>
        @section('title')
            {{ setting('seo.title') }} | {{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}
        @show
    </title>

    <meta name="author" content="Black Box">
    <meta name="geo.region" content="MX">
    <meta name="geo.placename" content="México">

    @section('seo')
        <meta name="title"
            content="{{ setting('seo.title') }} | {{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}" />
        <meta name="DC.title"
            content="{{ setting('seo.title') }} | {{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}" />
        <meta property="og.title"
            content="{{ setting('seo.title') }} | {{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}" />
        <meta property="og.site_name"
            content="{{ setting('seo.title') }} | {{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}" />
        <meta name="twitter.site_name"
            content="{{ setting('seo.title') }} | {{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}" />
        <meta name="twitter.site"
            content="{{ setting('seo.title') }} | {{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}" />

        <meta name="description" content="{{ setting('seo.description') }}" />
        <meta property="og.description" content="{{ setting('seo.description') }}" />
        <meta name="twitter.description" content="{{ setting('seo.description') }}" />

        <meta name="keywords" content="{{ setting('seo.keywords') ? implode(',', setting('seo.keywords')) : '' }}" />

        <meta property="og:type" content="article">
        <meta name="twitter:card" content="summary">
        <meta name="robots" content="all">
        <meta name="copyright" content="Copyright (c) {{ date('Y') }}">

        <meta property="og:image" content="{{ Storage::url(setting('seo.og_image')) }}">
        <meta name="twitter:image" content="{{ Storage::url(setting('seo.og_image')) }}">
    @show


    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ Storage::url(setting('seo.favicon')) }}" />

    {!! setting('seo.header') !!}

    @yield('head')

    @stack('before-css')

    {{-- CRITICAL --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/critical.min.css') }}"> --}}

    {{-- PRELOAD --}}
    <link rel="preload" href="{{ Vite::asset('resources/css/app.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <noscript>
        <link rel="stylesheet" href="{{ Vite::asset('resources/css/app.css') }}">
    </noscript>

    @stack('after-css')

</head>

<body>
    @include('layout.header.index')

    <main>
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
        </div>
    </main>

    @include('layout.footer.index')

    <x-layout.swal />

    @if (setting('social.whatsapp'))
        <x-layout.whatsapp />
    @endif

    {{-- scripts --}}
    @routes
    @livewireScripts
    <script src="{{ Vite::asset('resources/js/app.js') }}" defer></script>

    @stack('scripts')

</body>

</html>
