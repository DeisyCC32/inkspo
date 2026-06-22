<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inkspo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    style="
        margin:0;
        min-height:100vh;
        background-image:
            linear-gradient(
                rgba(0,0,0,.65),
                rgba(0,0,0,.65)
            ),
            url('{{ asset('images/login-register.jpg') }}');
        background-size:cover;
        background-position:center;
        background-repeat:no-repeat;
        background-attachment:fixed;
    "
>

    {{ $slot }}

</body>
</html>