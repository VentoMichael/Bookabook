@extends('layouts.app')

@section('content')
    @if(count($books))
        <h2 aria-level="2" class="hiddenTitle" id="reservationPage">
            Réservations
        </h2>
        <ul role="list" class="flex fixed right-0 justify-around flex-col">
            @for($i = 1; $i <=3;$i++)
                <li role="listitem">
                    <a href="#bloc{{$i}}" title="Bloc {{$i}}" id="linkBloc{{$i}}"
                       class="duration-300 rounded-xl border-orange-900 block my-2 border-2 hover:text-white hover:bg-orange-900 text-center sm:mx-4 p-3 sm:px-4">
                        {{$i}}
                    </a>
                </li>
            @endfor
        </ul>
        @foreach($books as $book)
            @if($book->academic_years != $oldBook->academic_years)
                <section id="bloc{{$book->academic_years}}">
                    <h3 aria-level="3"
                        class="rounded-xl my-2 block p-3 sm:px-12 md:px-16 mt-8 mb-2 mx-auto sm:w-2/4 w-full bg-orange-900 text-white text-center text-md border-orange-900 border-2">
                        Bloc {{$book->academic_years}}
                    </h3>
                    @endif
                    @if($book->orientation != $oldBook->orientation)
                        <section>
                            <h4 aria-level="4"
                                class="mx-auto rounded-xl my-2 block p-3 sm:px-12 md:px-16 mt-8 mb-2 sm:w-2/4 w-full text-center text-md border-orange-900 border-b-2 border-t-2">
                                {{$book->orientation}}
                            </h4>
                            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 justify-items-center">
                                @endif
                                <div class="flex flex-col justify-around gap-8">
                                    <section class="mb-12 mt-4">
                                        <h5 aria-level="5" class="text-xl mb-2 hiddenTitle">
                                            {{$book->title}}
                                        </h5>
                                        <div class="mb-8">
                                            <div class="sm:flex flex-col">
                                                <img role="img"
                                                     aria-label="Photo de couverture de {{$book->title}}"
                                                     class="sm:max-w-xs"
                                                     src="{{ asset('storage/'.$book->picture) }}"
                                                     alt="">
                                                <div class="mt-4">
                                                    <p class="text-xl">{{$book->title}}</p>
                                                    <p class="text-md">{{$book->total_quantity}}
                                                        commandes</p>
                                                </div>
                                            </div>
                                            <form
                                                aria-label="Envoie de notification pour {{$book->title}}"
                                                role="form"
                                                method="POST"
                                                action="{{ route('purchases.sendNotif',['book' => $book->title])}}">
                                                @csrf
                                                @method('PUT')
                                                <button role="button" name="sendNotifBook"
                                                        class="md:w-64 sm:self-center hover:bg-orange-900 hover:text-white linkAction rounded-xl w-full duration-300 border-2 px-4 mt-4 py-4">
                                                    Envoyer une notification de disponibilité
                                                </button>
                                            </form>
                                        </div>
                                    </section>
                                </div>
                                @if($book->orientation != $oldBook->orientation)
                            </div>
                        </section>
                    @endif
                    @if($book->academic_years != $oldBook->academic_years)
                </section>
            @endif
            @php
                $oldBook = $book;
            @endphp
        @endforeach
    @else
        <p>
            Aucun achat trouvé vus qu'il n'y a pas de commandes
        </p>
    @endif
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/purchaseLink.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
