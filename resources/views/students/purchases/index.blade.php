@extends('layouts.app')

@section('content')
    @if(count($user->orders))
    <section class="mt-12 max-w-5xl m-auto">
        <h3 aria-level="3" class="text-2xl">
            Historique de ses {{count($user->orders)}} dernières commandes
        </h3>
    </section>
@endif
@endsection
