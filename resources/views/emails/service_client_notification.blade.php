@component('mail::message')
# Nouvelle Demande de Stage

Une nouvelle demande de stage a été soumise par **{{ $studentName }}**.

**Détails de la demande :**  
- Université: {{ $internshipRequest->university }}  
- Domaine: {{ $internshipRequest->domaine }}  
- Niveau: {{ $internshipRequest->level }}  
- Durée: {{ $internshipRequest->duration }} mois  
- Commune: {{ $internshipRequest->commune }}  
- Structure: {{ $internshipRequest->structure }}  
- Binôme: {{ $internshipRequest->binome ?? 'Aucun' }}  

**Pièces jointes :**  
1. Lettre de recommandation  
2. Contrat de stage 


Cordialement,  
Système de Gestion de Stages  
{{ config('app.name') }}
@endcomponent