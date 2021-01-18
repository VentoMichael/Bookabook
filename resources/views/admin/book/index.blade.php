@extends('layouts.app')
@section('content')
    @if(count($books))
        @if (Session::has('message'))
            <div id="sucessMessage"
                 class="fixed top-0 bg-green-500 w-full p-4 right-0 text-center text-white">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('messageNotUpdate'))
            <div id="sucessMessage"
                 class="fixed top-0 bg-red-500 w-full p-4 right-0 text-center text-white">{{ Session::get('messageNotUpdate') }}</div>
        @endif
        <h2 aria-level="2" class="hiddenTitle">
            Les livres de l'application
        </h2>
        @include('partials.cta-menu')
        @foreach($letters as $key=>$letter)
            <section>
            <h3 aria-level="3" class="text-5xl block border-t mt-16 -mb-4"><span class="hiddenTitle">Les livres commençant par</span> {{$key}}</h3>
            <div id="{{$key}}"
                 class="grid mt-12 grid-cols-1 sm:grid-cols-2 sm:mr-8 lg:grid-cols-3 ml-4 flex-wrap justify-between gap-12 mr-4 lg:max-w-screen-xl lg:mx-auto">
                @foreach($letter as $book)
                    <section
                        class="flex flex-col justify-between border-2 rounded-xl p-4">
                        <div class="justify-between mx-auto" itemscope itemtype="https://schema.org/Book">
                            <img itemprop="illustrator" class="booksImg mb-4 mx-auto" role="img" aria-label="Photo de couverture de {{$book->title}}" src="{{ asset('storage/'.$book->picture) }}"
                                 alt="Photo de couverture de {{$book->title}}">
                            <h4 aria-level="4" class="text-2xl break-all">
                                {{$book->title}}
                            </h4>
                        </div>
                        <div class="mb-4 mt-10 text-center">
                                <a class="block cursor-pointer rounded-xl border duration-300 p-3 hover:bg-orange-900 hover:text-white" href="{{route('books.edit',['book'=>$book->title])}}">Éditer
                                    <span>{{$book->title}}</span></a>
                                <a class="cursor-pointer rounded-xl block mt-8 bg-orange-900 text-white p-3" href="{{route('books.show',['book'=>$book->title])}}">Plus d'informations sur
                                    <span>{{$book->title}}</span></a>
                        </div>
                    </section>
                @endforeach
            </div>
            </section>
        @endforeach
    @else
        <section class="max-w-5xl m-auto md:flex mt-12 sm:mt-16">
            <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/sad.svg')}}"
                 alt="Pictogramme d'un smiley triste">
            <h2 aria-level="2" class="ml-6 mr-6 text-2xl self-center">
                Oops, aucun livre encore ! <a class="underline" href="{{route('books.create')}}">Je vais en créer un</a>
            </h2>
        </section>
    @endif
    <nav role="navigation" aria-label="Navigation pour accéder à des étudiants en particuliers">
        <div class="hidden sm:inline inline-block fixed right-0 lettersContainer mr-6 text-center">
            <ul role="list">
                @foreach($letters as $key=>$letter)
                    <li role="listitem">
                        <a class="text-xl letterLink" href="#{{$key}}">{{$key}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
