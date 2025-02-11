<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Groovie')</title>
    <link rel="icon" href="{{ asset('img/logobleujaune.png') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/variables.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .nav-left a {
    color: white; /* Texte en blanc */
    text-decoration: none; /* Enlever le soulignement */
    font-weight: bold;
    margin-left: 20px; /* Décale légèrement à droite */
    transition: color 0.3s ease; /* Effet fluide */
    }

    .nav-left a:hover {
        color: #ffcc00; /* Jaune doré au survol */
    }
    </style>
    @yield('css')
</head>
<body>
    <header>
        @include('admin.partialsAdmin.header')
    </header>
    <main>
        @yield('content')
    </main>

    <footer>
        @include('admin.partialsAdmin.footer')
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('js')
</body>
</html>
