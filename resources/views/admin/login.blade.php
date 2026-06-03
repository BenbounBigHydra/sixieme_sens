<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - HUG</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Jersey+20&display=swap" rel="stylesheet">
</head>
<body class="bg-[#fffbf1] m-0 p-0 text-black">
    <div id="app">
        @php
            $errorsArray = $errors->all();
        @endphp
        <login-admin 
            csrf-token="{{ csrf_token() }}" 
            login-route="{{ route('login') }}"
            :errors='@json($errorsArray)'
        ></login-admin>
    </div>
</body>
</html>
