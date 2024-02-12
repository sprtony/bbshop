@extends('layout.master')

@section('content')
    @include('pages.contact.sections.banner')
    <section id="form" class="bg-[#f7f7f7]">
        <div class="h-5"></div>
        <div class="container px-5 lg:px-28">
            @livewire('form-contact')
        </div>
        <div class="h-5"></div>
    </section>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1386.8665856264493!2d-101.43826667519293!3d20.953477495411153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842b9b86ef436c9d%3A0xf1b53e7423e25519!2s%C3%81lvaro%20Obreg%C3%B3n%20252%2C%2036122%20Silao%2C%20Gto.!5e0!3m2!1ses!2smx!4v1699042350447!5m2!1ses!2smx"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection
