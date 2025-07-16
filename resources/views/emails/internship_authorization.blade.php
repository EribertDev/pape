@component('mail::message')
# Autorisation de Stage Approuvée

Bonjour {{ $internship->user->name }},

Votre demande de stage a été approuvée! Vous trouverez ci-joint le document officiel d'autorisation de stage.

**Détails du stage:**
- Université: {{ $internship->university }}
- Durée: {{ $internship->duration }} mois

@if($internship->binome)
**Binôme:** {{ $internship->binome }}
@endif



Cordialement,  
 
{{ config('app.name') }}
@endcomponent