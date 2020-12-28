@component('mail::message')
    # Votre livre commandé est arrivé!
    {{$book}} vient d'étre arriver dans mon bureau, vous pouvez passez aux horaires de bureau.
    @component('mail::button', ['url' => 'http://bookapp.test/admin/books/'.$book])
        Je viens voir
    @endcomponent
@endcomponent
