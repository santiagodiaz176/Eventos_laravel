<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Fuentes e íconos -->
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <!-- Estilos generales -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <!-- Estilo del panel administrador -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    {{-- Estilos específicos de cada vista --}}
    @yield('styles')
</head>
<body>

    {{-- Contenido principal --}}
    @yield('content')

    <script src="{{ asset('js/validaciones.js') }}"></script>

    <!-- Scripts base -->
    <script src="{{ asset('js/jquery-latest.js') }}"></script>

    {{-- Scripts específicos por vista --}}
    @yield('scripts')

</body>
</html>
