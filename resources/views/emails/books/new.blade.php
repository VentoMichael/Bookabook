@component('mail::message')
# Un nouveau livre est dans le marché !

{{$book->title}} vient d'étre créer.

@component('mail::button', ['url' => 'http://bookapp.test/admin/books'])
Je viens voir
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
