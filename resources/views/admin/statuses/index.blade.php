@extends('layouts.app')

@section('content')
    <section class="pl-8 mt-6 max-w-5xl m-auto">
        <h2 aria-level="2" class="text-2xl">
            Voici les commandes
        </h2>
        @foreach($users as $user)
            <div>
                @if($user->orders)
                    @foreach($user->orders as $order)
                        <div>
                            <section class="grid mt-12 grid-cols-1 sm:grid-cols-2 sm:mr-8 ml-4 flex-wrap justify-between gap-12 mr-4">
                                @foreach($order->books as $book)
                                    <div class="mx-auto mb-8 flex-col" >
                                        <img role="img" aria-label="Photo de couverture de {{$book->title}}" src="{{ asset('storage/'.$book->picture) }}"
                                             alt="Photo de couverture de {{$book->title}}">
                                        <h3 aria-level="3" class="mt-4 text-xl font-bold">{{$book->title}}</h3>
                                    </div>
                                @endforeach
                                @foreach($order->statuses as $status)
                                    <div class="text-center text-2xl col-span-2">
                                        <p class="rounded border-orange-900 border-b-2 border-t-2 p-3 inline">
                                            {{$status['name']}}
                                        </p>
                                    </div>
                                @endforeach
                                    <a href="#">
                                        Changer son statut
                                    </a>
                            </section>
                            <div class="h-2 bg-orange-900 block w-2/4 rounded-full mx-auto my-8"></div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
    </section>
@endsection
