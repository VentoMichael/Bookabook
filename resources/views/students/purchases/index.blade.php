@extends('layouts.app')

@section('content')
    @if(count($user->orders))
        <section class="max-w-5xl m-auto">
            <h2 aria-level="2" class="text-2xl">
                Historique de mes {{count($user->orders)}} dernières commandes
            </h2>
            @foreach($user->orders as $order)
                <section>
                    <h3 aria-level="3" class="mt-6 mb-4 text-lg">
                        La commande n°{{$loop->iteration}} contient les livres suivants :
                    </h3>
                    <section class="overflow-x-scroll flex gap-12 sm:gap-16 containerBooksStudents containerOrders  @if(count($user->orders) > 1) containerOrdersSection @endif">
                        @foreach($order->books as $book)
                            <div class="flex mb-8 flex-col my-16 mx-auto sm:mx-0 sm:my-0">
                                <div>
                                    <img class="max-w-xs" role="img"
                                         aria-label="Photo de couverture de {{$book->title}}"
                                         src="{{ asset('storage/'.$book->picture) }}"
                                         alt="Photo de couverture de {{$book->title}}">
                                </div>
                                <h4 aria-level="4" class="text-xl font-bold">{{$book->title}}</h4>
                            </div>
                        @endforeach
                    </section>
                    <div class="mt-12">
                        @foreach($order->statuses as $status)
                            @if($status['nameFr'])
                                <div class="text-center text-2xl">
                                    <p class="rounded border-orange-900 border-b-2 border-t-2 p-3 inline">
                                        {{$status['nameFr']}}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>
            @endforeach
        </section>
    @else
        <section class="max-w-5xl m-auto md:flex">
            <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/sad.svg')}}"
                 alt="Pictogramme d'un smiley triste">
            <h2 aria-level="2" class="ml-6 text-2xl self-center">
                Oops, aucun achat réaliser ! <a class="underline" href="{{route('dashboardUser.index')}}">Je vais voir
                    les différents livres</a>
            </h2>
        </section>
    @endif
@endsection
