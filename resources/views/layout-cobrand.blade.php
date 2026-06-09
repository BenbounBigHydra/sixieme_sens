<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donnons - Co-brand</title>
    <!-- Chargement des assets via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Préconnexion et importation des polices Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Jersey+20&display=swap" rel="stylesheet">
</head>
<body class="bg-[#fffbf1] text-hugDark font-inter">
    <!-- Conteneur principal de l'application Vue -->
    <div id="app">
        <!-- Composant d'en-tête Co-brand -->
        <header-cobrand :initial-data="{{ $initialData ?? 'null' }}"></header-cobrand>
        
        <!-- Zone de contenu dynamique injectée par les vues spécifiques -->
        <main>
            @yield('content')
        </main>
        
        <!-- Composant de pied de page -->
        @if (!isset($hideFooter) || !$hideFooter)
            <footer-cobrand :initial-data="{{ $initialData ?? 'null' }}"></footer-cobrand>
        @endif
    </div>
</body>
</html>
