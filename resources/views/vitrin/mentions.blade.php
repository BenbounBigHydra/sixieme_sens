<!-- Héritage du layout global -->
@extends('layout')

<!-- Définition de la section de contenu -->
@section('content')
<div class="px-4 md:px-8 lg:px-32 xl:px-40 py-12 max-w-desktop mx-auto min-h-screen">
    <a href="/" class="inline-block mb-8 font-['Jersey_20'] text-xl md:text-2xl text-[#0073E6] hover:underline">&larr; Retour à l'accueil</a>
    
    <img src="/images/YellowSquares.png" alt="Squares" class="h-6 w-auto object-contain mb-8 origin-center lg:origin-left" />
    
    <h1 class="font-['Jersey_20'] text-[36px] md:text-[64px] leading-[1.1] font-normal text-black mb-6 tracking-wide">Mentions Légales</h1>
    
    <div class="font-['Inter'] text-base md:text-lg text-black space-y-6">
        <p>
            Ce site est un projet réalisé dans un cadre académique. Il n'a pas de but lucratif et ne collecte pas de fonds réels.
        </p>
        <p>
            <strong>Éditeur du site :</strong><br>
            Hôpitaux Universitaires de Genève (HUG)<br>
            Rue Gabrielle-Perret-Gentil 4<br>
            1205 Genève<br>
            Suisse
        </p>
        <p>
            Pour de plus amples informations concernant les mentions légales des Hôpitaux Universitaires de Genève, veuillez consulter le site officiel : <a href="https://www.hug.ch" class="text-[#0073E6] hover:underline" target="_blank" rel="noopener noreferrer">www.hug.ch</a>.
        </p>
    </div>
</div>
@endsection
