<x-mail::message>
@component('mail::message')
# Nouvelle demande de collecte

**Entreprise :** {{ $data['nom'] }}
**Nombre d'employés :** {{ $data['employes'] }}
**Mail :** {{ $data['mail'] }}
**Téléphone :** {{ $data['telephone'] ?? '—' }}
**Message :** {{ $data['message'] ?? '—' }}

@endcomponent
</x-mail::message>
