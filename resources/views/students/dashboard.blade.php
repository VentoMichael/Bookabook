@extends('layouts.app')
@section('content')
    <h2 aria-level="2" class="hiddenTitle" id="reservationPage">
        Les livres de l'applications
    </h2>
    @if($books->count()>0)
        <div class="overflow-x-scroll flex gap-12 sm:gap-16 containerBooksStudents">
            @foreach($books as $book)
                <section class="w-48 relative flex justify-between flex-col">
                    <div>
                        <div class="cbx">
                            <input class="hidden" id="add{{$book->isbn}}" type="checkbox"/>
                            <label class="hidden" for="add{{$book->isbn}}"
                                   class="hiddenTitle">Ajouter
                                le livre au panier</label>
                            <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                                <path d="M2 8.36364L6.23077 12L13 2"></path>
                            </svg>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                            <defs>
                                <filter id="goo">
                                    <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                                    <fecolormatrix in="blur" mode="matrix"
                                                   values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7"
                                                   result="goo"></fecolormatrix>
                                    <feblend in="SourceGraphic" in2="goo"></feblend>
                                </filter>
                            </defs>
                        </svg>

                        <img src="{{asset('storage/'.$book->picture)}}" alt="Photo de couverture de {{$book->title}}">
                        <div>
                            <div
                                class="containerPrice w-24 mx-auto text-center rounded-lg relative bg-yellow-900 px-2 py-1">
                        <span class="text-white text-md">
                            {{$book->proposed_price}}€
                        </span>
                                <span class="text-white text-md line-through">
                            ({{$book->public_price}}€)
                        </span>
                            </div>
                            <h3 aria-level="3" class="text-xl font-medium mb-4">{{$book->title}}</h3>
                        </div>
                        <p>{{$book->author}}</p>
                        <p class="text-md">Maison d'édition : {{$book->publishing_house}}</p>
                        <p class="text-md">ISBN : {{$book->isbn}}</p>
                    </div>
                    <form action="{{route('cart.index',['id'=>$book->id])}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="flex justify-between mt-6 mb-4">
                            <div>
                                <p>Stock : {{$book->stock}}</p>
                            </div>
                        </div>
                        <a href="{{route('product.addToCart',['id'=>$book->id])}}"
                           class="addBookToCart text-center block cursor-pointer rounded-xl border duration-300 p-3 hover:bg-orange-900 hover:text-white">
                            Ajouter {{$book->title}} à mon panier
                        </a>
                    </form>
                    <a href="{{route('product.shoppingCart')}}"
                       class="text-center cursor-pointer rounded-xl w-full block mt-4 bg-orange-900 text-white p-3">
                        Voir mon panier
                    </a>
                </section>
            @endforeach
            @else
                <section class="max-w-5xl m-auto md:flex mt-12 sm:mt-16">
                    <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/sad.svg')}}"
                         alt="Pictogramme d'un smiley triste">
                    <h2 aria-level="2" class="ml-6 mr-6 text-2xl self-center">
                        Oops, aucun livre disponible !
                    </h2>
                </section>
        </div>
    @endif
@endsection
