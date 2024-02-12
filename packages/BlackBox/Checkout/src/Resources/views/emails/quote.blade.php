@extends('emails.layout')

@section('content')
    <h1>Datos de cotización</h1>
    <p style="margin:0;">
        <strong>Nombre completo:</strong> <span>{{ $quote->name }}</span><br />
        <strong>Correo eléctronico:</strong> <span>{{ $quote->email }}</span><br />
        <strong>Teléfono:</strong> <span>{{ $quote->phone }}</span><br />
        <strong>Solución que le interesa:</strong> <span>{{ $quote->solution }}</span><br />
        <strong>Código postal:</strong> <span>{{ $quote->postal_code }}</span><br />
        <strong>Estado:</strong> <span>{{ $quote->state }}</span><br />
        <strong>Ciudad:</strong> <span>{{ $quote->city }}</span><br />
        <strong>Comentario:</strong> <span>{{ $quote->message }}</span><br />
    </p>
@endsection
