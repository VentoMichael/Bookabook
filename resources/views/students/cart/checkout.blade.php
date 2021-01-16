@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        <section>
            <h2>Page de paiement</h2>
            @if($admin->bank_account)
            <p>
                Veuillez envoyez {{$total}} € au numéro de compte {{$admin->bank_account}} avec comme communication libre "Achat de livres, {{$user->name . ' ' . $user->surname . ' ' . date ("d.m.y",strtotime(Now()))}}@if($user->bank_account) ,{{$user->bank_account}}"@else"
                    <a class="underline" href="{{route('users.edit',$user->name)}}">Ajouter votre numéro de compte dans les paramètres</a> @endif
            </p>
            @else
            <p>
                Merci de prendre contact avec M. Spirlet, ou <a href="mailto:{{$admin->email}}">lui envoyez un message</a>
            </p>
                @endif
        </section>
    @endif
@endsection
