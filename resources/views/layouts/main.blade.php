<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConectaBiz</title>
    @vite('resources/css/app.css') <!-- Certifique-se de que o Vite está funcionando -->
    <link rel="icon" href="{{ asset('img/logo-conectabiz.ico') }}" type="image/x-icon">
</head>

<body>
    @yield('navbar')

    @yield('content')

    @yield('footer')
</body>
<script src="https://amei.homolog.kubernetes.sebrae.com.br/auth/js/keycloak.js"></script>
</html>
