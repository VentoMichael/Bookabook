@component('mail::message')
    # Votre livre commandé est arrivé!
    {{$book->title}} vient d'étre arriver dans mon bureau, vous pouvez passez aux horaires de bureau.
    @component('mail::button', ['url' => 'http://bookapp.test/admin/books'])
        Je viens voir
    @endcomponent
    Merci,<br>
    {{ config('app.name') }}
@endcomponent
