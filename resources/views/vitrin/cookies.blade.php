<!-- Héritage du layout global -->
@extends('layout')

<!-- Définition de la section de contenu -->
@section('content')
<div class="px-4 md:px-8 lg:px-32 xl:px-40 py-12 max-w-desktop mx-auto min-h-screen">
    <a href="/" class="inline-block mb-8 font-['Jersey_20'] text-xl md:text-2xl text-[#0073E6] hover:underline">&larr; Retour à l'accueil</a>
    
    <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-8 origin-center lg:origin-left" />
    
    <h1 class="font-['Jersey_20'] text-[36px] md:text-[64px] leading-[1.1] font-normal text-black mb-6 tracking-wide">Politique des Cookies</h1>
    
    <div class="font-['Inter'] text-base md:text-lg text-black space-y-6">
        <p>
            Ce site utilise des cookies de manière limitée, principalement pour assurer le bon fonctionnement de l'application (par exemple, la gestion des sessions) dans le cadre de ce projet académique.
        </p>
        <p>
            Nous n'utilisons pas de cookies de traçage publicitaire.
        </p>
        <p>
            Pour consulter la politique officielle de gestion des cookies des Hôpitaux Universitaires de Genève, veuillez visiter leur site web : <a href="https://www.hug.ch" class="text-[#0073E6] hover:underline" target="_blank" rel="noopener noreferrer">www.hug.ch</a>.
        </p>
    </div>
</div>
@endsection
