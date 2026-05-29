<!-- Héritage du layout global -->
@extends('layout')

<!-- Définition de la section de contenu -->
@section('content')
    <!-- Affichage du composant Vue pour la page des trophées -->
    <trophees-vitrine :initial-data="{{ $initialData }}"></trophees-vitrine>
@endsection
