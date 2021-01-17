@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        @if (Session::has('message'))
            <div id="sucessMessage"
                 class="fixed z-10 top-0 bg-green-500 w-full p-4 right-0 text-center text-white">{{ Session::get('messageBook') }}</div>
        @endif
        <section class="max-w-5xl m-auto md:flex">
            <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/cart.svg')}}" alt="Panier d'achats">
            <div>
                <h2 aria-level="2" class="mb-4 mr-6 text-2xl self-center">
                    Page de paiement
                </h2>
                @if($admin->bank_account)
                    <p>
                        Veuillez envoyez <b>{{$total}} €</b> au numéro de compte {{$admin->bank_account}} avec comme
                        communication libre <b>"Achat de
                        livres, {{$user->name . ' ' . $user->surname . ' ' . date ("d.m.y",strtotime(Now()))}}@if($user->bank_account)
                            ,{{$user->bank_account}}"</b>@else"</b>
                    </p>
                    <p class="mt-4">Pour plus de facilité, <a class="underline" href="{{route('users.edit',$user->name)}}">Ajouter
                            votre numéro de compte dans les paramètres</a> ou <a class="underline" href="mailto:{{$admin->email}}">transmettez-lui
                            votre numéro de compte via mail</a> @endif
                    </p>
                @else
                    <p>
                        Merci de prendre contact avec M. Spirlet, ou <a class="underline" href="mailto:{{$admin->email}}">lui envoyez un
                            mail</a>
                    </p>
                @endif
                <a href="{{route('dashboardUser.index')}}" type="submit"
                        class="duration-300 w-full rounded-xl mt-6 p-3 border bg-orange-900 text-white">
                    Retour à la page d'accueil
                </a>
            </div>
        </section>
    @endif
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
