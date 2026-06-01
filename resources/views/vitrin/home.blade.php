<!-- Héritage du layout global -->
@extends('layout')

<!-- Définition de la section de contenu -->
@section('content')
    <!-- Affichage du composant Vue pour la page d'accueil -->
    <home-vitrine :initial-data="{{ $initialData ?? 'null' }}"></home-vitrine>
@endsection
