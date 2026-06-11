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
    <link rel="icon" href="/images/dono_smiling_square.png">
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
