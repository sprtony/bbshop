<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
</head>

<body style="font-family: arial;">
    <h1 style="background:{{ setting('email.color') }}; color:white; padding: 40px 20px; margin:0;text-align:center">
        @if ($logo = setting('email.logo'))
            <img src="{{ Storage::url($logo) }}" alt="{{ setting('seo.title') }}">
        @else
            {{ setting('seo.title') }}
        @endif
    </h1>
    <div style="border: 1px solid {{ setting('email.color') }}; padding: 30px 20px;">

        @yield('content')


    </div>
</body>

</html>
