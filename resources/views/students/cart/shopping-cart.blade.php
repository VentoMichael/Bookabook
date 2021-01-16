@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        <section>
            <h2 aria-level="2" class="hiddenTitle">
                Commande de livres
            </h2>
            <section class="containerCart grid gap-12 sm:gap-20 mb-6 lg:grid-cols-3">
                @foreach($books as $book => $value)
                    <div>
                        <div class="flex">
                            <img class="pictureBookBuy" src="{{asset('storage/'.$value['item']->picture)}}"
                                 alt="Photo de couverture de {{$value['item']->title}}">
                            <div class="ml-4">
                                <h3 class="mb-4" aria-level="3">{{ $value['item']['title'] }}</h3>
                                <strong>{{ $value['item']['author'] }}</strong>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mt-4">
                                <p>
                                    Prix unitaire : {{ $value['item']->proposed_price }} €
                                </p>
                                <p>
                                    Prix total : {{ $value['item']->proposed_price * $value['stock']}} €
                                </p>
                            </div>
                            <p class="mt-6 -mb-4">
                                Quantité : <span>{{ $value['stock']}}</span>
                            </p>
                            <form action="{{route('product.update',['id'=>$value['item']->id])}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">

                                <ul class="flex justify-between mb-8">
                                    <li>
                                        <button name="remove_quantity"
                                                class="duration-300 w-full rounded-xl mt-6 p-3 border hover:bg-orange-900 hover:text-white">
                                            - 1
                                        </button>
                                    </li>
                                    <li>
                                        <button name="add_quantity"
                                                class="duration-300 w-full rounded-xl mt-6 p-3 border hover:bg-orange-900 hover:text-white">
                                            + 1
                                        </button>
                                    </li>
                                </ul>
                            </form>
                            <div>
                                <button href="#"
                                        class="duration-300 w-full rounded-xl p-3 border bg-orange-900 text-white">
                                    Supprimer le livre
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
            <section class="border-t-2 border-b-2 border-red-800 py-4 mt-12">
                <div class="max-w-3xl mx-auto">
                    <h2 aria-level="2" class="mb-4 text-xl">
                        La commande comprend :
                    </h2>
                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2">
                        @foreach($books as $book => $value)
                            <section>
                                <h3 class="" aria-level="3">
                                    - {{ $value['item']['title'] }}
                                </h3>
                                <p>
                                    Quantité : <span>{{ $value['stock']}}</span>
                                </p>
                            </section>
                        @endforeach
                    </div>
                </div>
            </section>
            <div class="border-b-2 border-red-800 py-4 mb-8">
                <p class="max-w-3xl mx-auto text-xl">Le montant total est de <b>{{ $totalPrice }} €</b></p>
            </div>
        </section>
        <div class="grid sm:gap-8 grid-cols-1 sm:grid-cols-2">
            <button role="button" name="save" type="submit"
                    class="duration-300 w-full rounded-xl mt-6 p-3 border hover:bg-orange-900 hover:text-white">
                Sauvegarder la commande
            </button>
            <a role="button" href="{{route('checkout.index')}}"
               class="w-full text-center rounded-xl mt-6 bg-orange-900 text-white p-3"
               type="submit">
                Finaliser la commande
            </a>
        </div>
    @else
        <section class="max-w-5xl m-auto md:flex mt-12 sm:mt-16">
            <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/sad.svg')}}"
                 alt="Pictogramme d'un smiley triste">
            <h2 aria-level="2" class="ml-6 mr-6 text-2xl self-center">
                Oops, aucun livre dans le panier, <a class="underline" href="{{route('dashboardUser.index')}}">j'en
                    ajoute</a> !
            </h2>
        </section>
    @endif
@endsection
