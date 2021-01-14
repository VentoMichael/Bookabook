@extends('layouts.app')
@section('content')
    <h2 aria-level="2" class="hiddenTitle" id="reservationPage">
        Les livres de l'applications
    </h2>
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
                <form action="#" method="POST">
                    <div class="flex justify-between mt-6 mb-4">
                        <div>
                            <p>Stock : {{$book->stock}}</p>
                        </div>
                        <div>
                            <label for="quantityBook">Quantité</label>
                            <select name="quantityBook" class="selectBook" id="quantityBook{{$book->isbn}}">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                    </div>
                    <button id="addBook{{$book->isbn}}"
                            class="addBookToCart text-center block cursor-pointer rounded-xl border duration-300 p-3 hover:bg-orange-900 hover:text-white">
                        Ajouter {{$book->title}} à mon panier
                    </button>
                    <a href="{{route('cart.index')}}"
                        class="text-center cursor-pointer rounded-xl w-full block mt-4 bg-orange-900 text-white p-3">
                        Voir mon panier
                    </a>
                </form>
            </section>
        @endforeach
    </div>
@endsection
