<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - HUG</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

    <div id="app">
        <login-component csrf-token="{{ csrf_token() }}"></login-component>
    </div>

    <form action="/login" method="POST">
        @csrf <label>Email :</label>
        <input type="email" name="email" value="admin@hug.ch" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" value="password" required><br><br>

        <button type="submit">Tester la connexion</button>
    </form>

    @vite(['resources/js/app.js'])
</body>
</html>
