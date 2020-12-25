@extends('layouts.app')

@section('content')
    <section class="relative">
        @if (Session::has('message'))
            <div id="sucessMessage"
                 class="fixed top-0 bg-green-500 w-full p-4 right-0 text-center text-white">{{ Session::get('message') }}</div>
        @endif
        <h2 aria-level="2" class="hiddenTitle">
            Informations personnelles de {{$user->name}}
        </h2>
        <a class="backLink text-transparent text-xl relative text-2xl" title="Retour en arrière"
           href="{{route('users.index')}}">Retour
            en arrière</a>
        <div class="md:max-w-3xl mx-auto">
            <div class="rounded-xl max-w-5xl m-auto">
                <div>
                    <div class="flex justify-between">
                        @include('partials.user-avatar')
                        <section>
                            <div itemscope itemtype="https://schema.org/Person">
                                <h3 aria-level="3" class="text-xl break-all ml-4 mr-4">
                                    <span itemprop="familyName">{{$user->name}}</span> <span
                                        itemprop="givenName">{{$user->surname}}</span>
                                </h3>
                            </div>
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
                        </section>

                    </div>
                    <div class="text-center p-4 mt-8 -mb-8">
                        <a class="rounded-xl block bg-orange-900 text-white p-3" href="mailto:{{$user->email}}">Envoyer
                            un
                            mail à {{$user->name}} {{$user->surname}}</a>
                    </div>
                </div>
            </div>
            @if(count($user->orders))
                <section class="mt-12 max-w-5xl m-auto">
                    <h3 aria-level="3" class="text-2xl">
                        Historique de ses {{count($user->orders)}} dernières commandes
                    </h3>
                    <div>
                        @if($user->orders)
                            @foreach($user->orders as $order)
                                <section>
                                    <h4 aria-level="4" class="mt-6 mb-4 text-lg">
                                        La commande n°{{$loop->iteration}} contient les livres suivants :
                                    </h4>
                                    <section class="containerOrder sm:grid sm:grid-cols-2 sm:gap-8">
                                        @foreach($order->books as $book)
                                            <div class="flex mb-8 flex-col my-16 mx-auto sm:mx-0 sm:my-0">
                                                <div>
                                                    <img role="img"
                                                         aria-label="Photo de couverture de {{$book->title}}"
                                                         src="{{ asset('storage/'.$book->picture) }}"
                                                         alt="Photo de couverture de {{$book->title}}">
                                                </div>
                                                <h5 aria-level="5" class="text-xl font-bold">{{$book->title}}</h5>
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
                                        <div class="text-center mt-8">
                                            <a class="rounded-xl mt-8 p-3 border bg-orange-900 text-white text-center sm:w-3/4 sm:mx-auto md:w-2/4"
                                               href="{{route('statuses.edit',[$user,$status->id])}}">Changer le
                                                status de
                                                cette commande
                                            </a>
                                        </div>
                                        <div class="h-2 bg-orange-900 block w-2/4 rounded-full mx-auto my-8"></div>
                                    </div>
                                </section>
                            @endforeach
                        @endif
                    </div>
                </section>
            @endif
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
