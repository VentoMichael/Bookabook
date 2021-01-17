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
                            <form class="flex justify-between mb-8" action="{{route('checkout.index')}}" method="POST">
                                @csrf
                                <div>
                                <label for="quantity">
                                        Quantité :</label>
                                <input class="duration-300 rounded-xl mt-6 p-3 border" min="0" type="number" name="quantity" max="10" value="{{$value['stock']}}">
                                </div>
                                <input class="duration-300 cursor-pointer rounded-xl mt-6 p-3 border bg-white hover:bg-orange-900 hover:text-white" type="submit" value="Changer">
                            </form>
                            <form action="{{route('deleteBookOrder.index')}}" method="post">
                                @csrf
                                @method('delete')
                            <div>
                                <input type="hidden" name="book_id" value="{{$value['item']}}">
                                <button
                                    class="duration-300 w-full rounded-xl p-3 border bg-orange-900 text-white">
                                    Supprimer le livre
                                </button>
                            </div>
                            </form>
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
            <form action="{{route('checkout.index')}}" method="POST" id="checkoutForm" class="grid sm:gap-8 grid-cols-1 sm:grid-cols-2">
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
