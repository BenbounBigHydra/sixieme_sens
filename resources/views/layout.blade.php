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
    <link rel="icon" href="/images/hug_icon_square.png">
</head>
<body class="bg-[#fffbf1] text-hugDark font-inter">
    <!-- Conteneur principal de l'application Vue -->
    <div id="app">
        <!-- Composant d'en-tête global -->
        @if(!isset($hideHeaderFooter) || !$hideHeaderFooter)
            <header-vitrine></header-vitrine>
        @endif
        
        <!-- Avertissement de projet académique (Global) -->
        @if(!isset($hideBanner) || !$hideBanner)
        <div class="w-full bg-[#fffbf1]">
            <div class="max-w-desktop mx-auto px-8 md:px-20 lg:px-32 xl:px-40 pt-12">
                <div class="bg-[#0073e6] text-white font-['Jersey_20'] tracking-wide text-lg sm:text-xl md:text-2xl text-center py-3 px-2 border-2 border-black">
                    <span class="hidden md:inline">Ceci est un projet réalisé dans un cadre académique. N’organisez pas de collecte ;)</span>
                    <span class="inline md:hidden">Ceci est un projet réalisé dans un cadre académique.</span>
                </div>
            </div>
        </div>
        @endif

        <!-- Zone de contenu dynamique injectée par les vues spécifiques -->
        <main>
            @yield('content')
        </main>

        <!-- Composant de pied de page global -->
        @if(!isset($hideHeaderFooter) || !$hideHeaderFooter)
            <footer-vitrine></footer-vitrine>
        @endif
    </div>

    <!-- Service Worker et Détection Hors-ligne -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js').then(registration => {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, err => {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }

        // Overlay game immediately when connection is lost
        window.addEventListener('offline', () => {
            if (!document.getElementById('offline-iframe')) {
                const iframe = document.createElement('iframe');
                iframe.id = 'offline-iframe';
                iframe.src = '/offline.html';
                iframe.style.position = 'fixed';
                iframe.style.top = '0';
                iframe.style.left = '0';
                iframe.style.width = '100vw';
                iframe.style.height = '100vh';
                iframe.style.border = 'none';
                iframe.style.zIndex = '99999';
                document.body.appendChild(iframe);
            }
        });

        // Remove game when connection is restored
        window.addEventListener('online', () => {
            const iframe = document.getElementById('offline-iframe');
            if (iframe) {
                iframe.remove();
            }
        });
    </script>
</body>
</html>
