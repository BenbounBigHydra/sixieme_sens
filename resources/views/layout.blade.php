<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trophées HUG</title>
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
        <!-- Composant d'en-tête global -->
        <header-vitrine></header-vitrine>
        
        <!-- Avertissement de projet académique (Global) -->
        <div class="w-full bg-[#fffbf1]">
            <div class="max-w-desktop mx-auto px-4 md:px-8 pt-12">
                <div class="bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-2xl text-center py-3 border-2 border-black">
                    <span class="hidden md:inline">Ceci est un projet réalisé dans un cadre académique. N’organisez pas de collecte ;)</span>
                    <span class="inline md:hidden">Ceci est un projet réalisé dans <br/> un cadre académique.</span>
                </div>
            </div>
        </div>

        <!-- Zone de contenu dynamique injectée par les vues spécifiques -->
        <main>
            @yield('content')
        </main>

        <!-- Composant de pied de page global -->
        <footer-vitrine></footer-vitrine>
    </div>
</body>
</html>
