@extends('layouts.app')
@section('content')
    <h2 aria-level="2" class="hiddenTitle" id="reservationPage">
        Les livres de l'applications
    </h2>
    @if (Session::has('messageBook'))
        <div id="sucessMessage"
             class="fixed z-10 top-0 bg-green-500 w-full p-4 right-0 text-center text-white">{{ Session::get('messageBook') }}</div>
    @endif
    @if (Session::has('messageSavePayment'))
        <div id="sucessMessage"
             class="fixed z-20 top-0 bg-green-500 w-full p-4 right-0 text-center text-white">{{ Session::get('messageSavePayment') }}</div>
    @endif
    @if($books->count()>0)
        <div class="overflow-x-scroll flex gap-12 sm:gap-16 containerBooksStudents">
            @foreach($books as $book)
                <section class="w-48 relative flex justify-between flex-col">
                    <div>
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
        </div>
    @else
        <section class="max-w-5xl m-auto md:flex mt-12 sm:mt-16">
            <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/sad.svg')}}"
                 alt="Pictogramme d'un smiley triste">
            <h2 aria-level="2" class="ml-6 mr-6 text-2xl self-center">
                Oops, aucun livre encore disponible, attendons Mr. Spirlet avec patience !
            </h2>
        </section>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
