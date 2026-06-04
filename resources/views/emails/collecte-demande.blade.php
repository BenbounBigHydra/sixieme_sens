<x-mail::message>
@component('mail::message')
# Nouvelle demande de collecte

**Entreprise :** {{ $data['nom'] }}
<br>
**Nombre d'employés :** {{ $data['employes'] }}
<br>
**Mail :** {{ $data['mail'] }}
<br>
**Téléphone :** {{ $data['telephone'] ?? '—' }}
<br>
**Message :** {{ $data['message'] ?? '—' }}

@endcomponent
</x-mail::message>
