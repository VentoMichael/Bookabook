@component('mail::message')
# Informations du profil

Les informations que vous avez changé sur votre profil ont bien été prises en compte.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/admin'])
Visiter {{ config('app.name') }}
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
