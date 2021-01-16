@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        <section>
            <h2 aria-level="2" class="hiddenTitle">
                Commande de livres
            </h2>
            <section>
                @foreach($books as $book => $value)
                    <div>
                        <img src="{{asset('storage/'.$value['item']->picture)}}"
                             alt="Photo de couverture de {{$value['item']->title}}">
                        <div>
                            <h3 aria-level="3">{{ $value['item']['title'] }}</h3>
                            <strong>{{ $value['item']['author'] }}</strong>
                        </div>
                        <div>
                            <p>
                                Prix unitaire : {{ $value['item']->proposed_price }} €
                            </p>
                            <p>
                                Prix total : {{ $value['item']->proposed_price * $value['stock']}} €
                            </p>
                            Quantité : <span>{{ $value['stock']}}</span>
                            <ul>
                                <li>
                                    <button >Réduire de 1</button>
                                </li>
                                <li><a href="#">Ajouter de 1</a></li>
                                <li><a href="#"
                                       class="duration-300 w-full rounded-xl mt-6 p-3 border hover:bg-orange-900 hover:text-white">Supprimer
                                        le livre</a></li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </section>
            <section>
                <h2 aria-level="2">
                    La commande comprend
                </h2>
                <span>
                    :
                </span>
                <section>
                    <h3 aria-level="3">
                        {{ $value['item']['title'] }}
                    </h3>
                    <p>
                        Quantité : <span>{{ $value['stock']}}</span>
                    </p>
                </section>
            </section>
            <div>
                <p>Le montant total est de {{ $totalPrice }} €</p>
            </div>
        </section>
        <button role="button" name="save" type="submit"
                class="duration-300 w-full rounded-xl mt-6 p-3 border hover:bg-orange-900 hover:text-white">
            Sauvegarder la commande
        </button>
        <a role="button" href="{{route('checkout.index')}}" class="w-full rounded-xl mt-6 bg-orange-900 text-white p-3" type="submit">
            Finaliser la commande
        </a>
    @else
        <section class="max-w-5xl m-auto md:flex mt-12 sm:mt-16">
            <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/sad.svg')}}"
                 alt="Pictogramme d'un smiley triste">
            <h2 aria-level="2" class="ml-6 mr-6 text-2xl self-center">
                Oops, aucun livre disponible !
            </h2>
        </section>
    @endif
@endsection
