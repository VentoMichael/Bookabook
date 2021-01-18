@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        <section>
            <h2 aria-level="2" class="hiddenTitle">
                Commande de livres
            </h2>
            <section class="containerCart grid gap-12 sm:gap-20 mb-6 lg:grid-cols-3">
                @foreach($books as $book)
                    <div>
                        <div class="flex">
                            <img class="pictureBookBuy" src="{{asset('storage/'.$book['item']->picture)}}"
                                 alt="Photo de couverture de {{$book['item']->title}}">
                            <div class="ml-4">
                                <h3 class="mb-4 text-xl font-black" aria-level="3">{{ $book['item']['title'] }}</h3>
                                <strong class="italic">{{ $book['item']['author'] }}</strong>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mt-4">
                                <p>
                                    Prix unitaire : {{ $book['item']->proposed_price }} €
                                </p>
                                <p>
                                    Prix total : {{ $book['item']->proposed_price * $book['stock']}} €
                                </p>
                            </div>
                            <div class="mt-4 mb-2">
                                <p>
                                    Quantité : {{$book['stock']}}</p>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex justify-between">
                                    <a class="duration-300 rounded-xl p-3 border hover:bg-orange-900 hover:text-white" href="{{ route('productReducedByOne.index', ['id' => $book['item']['id']]) }}">-
                                        1</a>
                                    <a class="duration-300 rounded-xl p-3 border hover:bg-orange-900 hover:text-white" href="{{ route('productAddByOne.index', ['id' => $book['item']['id']]) }}">+
                                        1</a>
                                </div>
                                <a class="w-full text-center rounded-xl mt-6 bg-orange-900 text-white p-3" href="{{ route('product.remove', ['id' => $book['item']['id']]) }}">Supprimer le livre</a>
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
                        @foreach($books as $book)
                            <section>
                                <h3 class="" aria-level="3">
                                    - {{ $book['item']['title'] }}
                                </h3>
                                <p>
                                    Quantité : <span>{{ $book['stock']}}</span>
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
        <form action="{{route('checkout.index')}}" method="POST" id="checkoutForm"
              class="grid sm:gap-8 grid-cols-1 sm:grid-cols-2">
            @csrf
            <button role="button" name="save" type="submit"
                    class="duration-300 w-full rounded-xl mt-6 p-3 border hover:bg-orange-900 hover:text-white">
                Sauvegarder la commande
            </button>
            <button role="button" name="addOrder"
                    class="w-full text-center rounded-xl mt-6 bg-orange-900 text-white p-3"
                    type="submit">
                Finaliser la commande
            </button>
        </form>
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
