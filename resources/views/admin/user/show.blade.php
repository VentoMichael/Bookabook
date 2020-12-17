@extends('layouts.app')

@section('content')
    <div class="relative">
        <a class="backLink text-transparent text-xl relative text-2xl" title="Retour en arrière"
           href="{{route('users.index')}}">Retour
            en arrière</a>
        <section class="rounded-xl p-4 max-w-5xl m-auto">
            <div>
                <div class="flex justify-between">
                    @include('partials.user-avatar')
                    <section>
                        <h2 aria-level="2" class="hiddenTitle">
                            Informations personnelles
                        </h2>
                        <div itemscope itemtype="https://schema.org/Person">
                            <h3 aria-level="3" class="text-xl break-all ml-4 mr-4">
                                <span itemprop="familyName">{{$user->name}}</span> <span itemprop="givenName">{{$user->surname}}</span>
                            </h3>
                        </div>
                        @if($userAdmin)
                            <div class="flex justify-around mt-8">
                                <div class="rounded-xl bg-orange-900 p-3 text-center">
                                    <div class="containerBookSvg mb-4 self-center"></div>
                                    @if(count($user->orders) >= 1)
                                        <p class="text-xl text-white font-hairline">{{$totalbooks}}</p>
                                    @else
                                        <p class="text-xl text-white font-hairline">0</p>
                                    @endif
                                </div>
                                <div class="rounded-xl bg-orange-900 p-3 pt-3 relative justify-around text-center">
                                    <div class="containerGroupSvg mb-2 m-auto"></div>
                                    <p class="text-xl text-white font-hairline">{{$user->group}}</p>
                                </div>
                            </div>
                        @endif
                    </section>

                </div>
                <div class="text-center p-4 mt-8 -mb-8">
                    <a class="rounded-xl block bg-orange-900 text-white p-3" href="mailto:{{$user->email}}">Envoyer un
                        mail à {{$user->name}} {{$user->surname}}</a>
                </div>
            </div>
        </section>
        @if(count($user->orders))
            <section class="pl-8 mt-6 max-w-5xl m-auto">
                <h2 aria-level="2" class="text-2xl">
                    Historique de ses {{count($user->orders)}} dernières commandes
                </h2>
                <section>
                    @if($user->orders)
                        @foreach($user->orders as $order)
                            <section>
                                <h3 aria-level="3" class="mt-6 mb-4">
                                    La commande n°{{$loop->iteration}} contient les livres suivants :
                                </h3>
                                <section>
                                    @foreach($order->books as $book)
                                        <div class="flex mb-8">
                                            <img role="img" aria-label="Photo de couverture de {{$book->title}}" src="{{ asset('storage/'.$book->picture) }}"
                                                 alt="Photo de couverture de {{$book->title}}">
                                            <h4 aria-level="4" class="ml-4 text-xl font-bold">{{$book->title}}</h4>
                                        </div>
                                    @endforeach
                                    @foreach($order->statuses as $status)
                                        <div class="text-center text-2xl">
                                            <p class="rounded border-orange-900 border-b-2 border-t-2 p-3 inline">
                                                {{$status['name']}}
                                            </p>
                                        </div>
                                    @endforeach
                                        <div class="sm:gap-12 grid sm:grid-cols-2">
                                            <a href="{{route('users.statusedit',[$user,$status])}}" class="rounded-xl mt-6 p-3 border bg-orange-900 text-white text-center">Changer le status de cette commande
                                            </a>
                                        </div>
                                    <div class="h-2 bg-orange-900 block w-2/4 rounded-full mx-auto my-8"></div>
                                </section>
                            </section>
                        @endforeach
                    @endif
                </section>
            </section>
        @endif
    </div>
@endsection
