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
        <div class="md:max-w-3xl mx-auto @if($user->suspended === 1) opacity-50 cursor-not-allowed @endif">
            <div class="rounded-xl max-w-5xl m-auto">
                <div>
                    <div class="flex justify-between flex-col sm:flex-row">
                        @include('partials.user-avatar')
                        <section class="self-center sm:self-start">
                            <div itemscope itemtype="https://schema.org/Person">
                                <h3 aria-level="3" class="text-xl break-all ml-4 mr-4">
                                    <span itemprop="familyName">{{$user->name}}</span> <span
                                        itemprop="givenName">{{$user->surname}}</span>
                                </h3>
                            </div>
                            @if(!\App\Models\User::student())
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
                    @if(Auth::user()->is_administrator)

                    <div class="text-center mt-8 -mb-8">
                        <a class="@if($user->suspended === 1) pointer-events-none @endif rounded-xl block bg-orange-900 text-white p-3"
                           href="mailto:{{$user->email}}">Envoyer
                            un
                            mail à {{$user->name}} {{$user->surname}}</a>
                    </div>
                        @endif
                </div>
            </div>
            @if(count($user->orders) > 0)
                <section class="mt-12 max-w-5xl m-auto">
                    <h3 aria-level="3" class="text-2xl">
                        Historique de ses {{count($user->orders)}} dernières commandes
                    </h3>
                    <div>
                        @foreach($user->orders as $order)
                            @if($order['is_draft'] === 0)

                            <section>
                                <div class="flex justify-between">
                                    <h4 aria-level="4" class="mt-6 mb-4 text-lg">
                                        La commande n°{{$loop->iteration}} contient les livres suivants :
                                    </h4>
                                    <img class="arrowScroll @if($order->books->count() < 3) sm:hidden @endif"
                                         src="{{asset('svg/right-arrow.svg')}}" alt="Flèche">
                                </div>
                                <section
                                    class="overflow-x-scroll flex gap-12 sm:gap-16 containerBooksStudents containerOrders @if(count($user->orders) > 1) containerOrdersSection @endif sm:pt-12 sm:pb-3">
                                    @foreach($order->books as $book)
                                        <div class="max-w-xs flex mb-8 flex-col my-16 mx-auto sm:mx-0 sm:my-0">
                                            <div>
                                                <img class="booksImg max-w-xs" role="img"
                                                     aria-label="Photo de couverture de {{$book->title}}"
                                                     src="{{ asset('storage/'.$book->picture) }}"
                                                     alt="Photo de couverture de {{$book->title}}">
                                            </div>
                                            <h5 aria-level="5" class="text-lg font-bold">{{$book->title}}</h5>
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
                                        <a class="@if($user->suspended === 1) pointer-events-none @endif rounded-xl mt-8 p-3 border bg-orange-900 text-white text-center sm:w-3/4 sm:mx-auto md:w-2/4"
                                           href="{{route('statuses.edit',['user'=>$user->name,'id'=>$order->id])}}">Changer
                                            le
                                            status de
                                            cette commande
                                        </a>
                                    </div>
                                    <div class="h-2 bg-orange-900 block w-2/4 rounded-full mx-auto my-8"></div>
                                </div>
                            </section>
                            @endif
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
        @if(Auth::user()->is_administrator)

            @if($user->suspended === 0)
                <form class="max-w-5xl mx-auto md:max-w-3xl" action="{{route('users.update',['user' => $user->name])}}"
                      aria-label="Mettre {{$user->name}} en suspend" role="form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="text-center mt-8">
                        <button name="suspend"
                                class="rounded-xl mt-8 py-3 bg-red-700 text-white text-center w-full sm:mx-auto">
                            Suspendre {{$user->name}} {{$user->surname}}
                        </button>
                    </div>
                </form>
            @else
                <form class="max-w-5xl mx-auto md:max-w-3xl" action="{{route('users.update',['user' => $user->name])}}"
                      aria-label="Annuler la suspension de {{$user->name}}" role="form" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="text-center mt-8">
                        <button name="noSuspend"
                                class="rounded-xl mt-8 py-3 bg-red-700 text-white text-center w-full sm:mx-auto">
                            Annuler la suspension de {{$user->name}} {{$user->surname}}
                        </button>
                    </div>
                </form>
            @endif
        @endif
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
