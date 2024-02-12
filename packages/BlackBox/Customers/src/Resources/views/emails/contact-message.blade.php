@extends('emails.layout')

@section('content')
    <h1>Datos de contacto</h1>
    <p style="margin:0;">
        <strong>Nombre completo:</strong> <span>{{ $contact->name }}</span><br />
        <strong>Correo eléctronico:</strong> <span>{{ $contact->email }}</span><br />
        <strong>Teléfono:</strong> <span>{{ $contact->phone }}</span><br />
        <strong>Whatsapp:</strong> <span>{{ $contact->whatsapp }}</span><br />
        <strong>Dirección:</strong> <span>{{ $contact->street }}</span><br />
        <strong>Código postal:</strong> <span>{{ $contact->postal_code }}</span><br />
        <strong>Estado:</strong> <span>{{ $contact->state }}</span><br />
        <strong>Ciudad:</strong> <span>{{ $contact->city }}</span><br />
        <strong>Comentario y/o sugerencia:</strong> <span>{{ $contact->message }}</span><br />
    </p>
@endsection
