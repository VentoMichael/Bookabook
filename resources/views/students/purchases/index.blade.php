@extends('layouts.app')

@section('content')
    @if($commandDraft->count() > 0 || $commandNoDraft->count() > 0)
    <div class="justify-center flex mb-12 flex-col sm:flex-row sm:mr-8">
        <a class="{{ Route::currentRouteName() === 'purchasesUser.index' ? "bg-orange-900 text-white border-2 border-orange-900 hover:text-white " : "" }}sm:self-center linkAction rounded-xl border-2 border-orange-900 my-4 sm:my-0 w-full hover:bg-orange-900 md:w-64 sm:mx-8 hover:text-white duration-300 px-4 pt-4 pb-4"
           href="{{route('purchasesUser.index')}}">
            Voir mes commandes
        </a>
        @if($commandDraft->count() > 0)
            <a class="{{ Route::currentRouteName() === 'draftPurchasesUser.index' ? "bg-orange-900 text-white border-2 border-orange-900 hover:text-white " : "" }}sm:self-center linkAction rounded-xl border-2 border-orange-900 my-4 sm:my-0 w-full hover:bg-orange-900 md:w-64 sm:mx-8 hover:text-white duration-300 px-4 pt-4 pb-4"
               href="{{route('draftPurchasesUser.index')}}">
                @if($commandDraft->count() > 1)Voir mes sauvegardes @else Voir ma sauvegarde @endif
            </a>
        @endif
    </div>
    @endif
    @if(count($commandNoDraft) > 0)
        <section class="max-w-5xl m-auto">
            <h2 aria-level="2" class="text-2xl">
                Historique de {{count($user->orders) >1 ? "mes dernières commandes" : "ma dernière commande"}}
            </h2>
            <p class="textBook">
                Le(s) livre(s) sera(ont) disponible(s) auprès du bureau de M. Spirlet après reçu de votre paiement, vous
                recevrez in mail quand le(s) livre(s) sera(ont) disponible(s).
            </p>
            @foreach($commandNoDraft as $order)
                <section class="mt-16">
                        <h3 aria-level="3" class="-mb-8 text-xl ">
                            Commande passée le {{date("d-m-Y",strtotime($order->created_at))}}
                        </h3>
                    <section
                        class="overflow-x-scroll flex gap-12 sm:gap-16 containerBooksStudents containerOrders @if(count($user->orders) > 1) containerOrdersSection @endif sm:pt-12 sm:pb-3">
                        @foreach($order->books as $book)
                            <div class="max-w-xs flex mb-8 flex-col my-16 mx-auto sm:mx-0 sm:my-0">
                                <div>
                                    <img class="max-w-xs" role="img"
                                         aria-label="Photo de couverture de {{$book->title}}"
                                         src="{{ asset('storage/'.$book->picture) }}"
                                         alt="Photo de couverture de {{$book->title}}">
                                </div>
                                <h4 aria-level="4" class="text-lg font-bold">{{$book->title}}</h4>
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
            <h2 aria-level="2" class="ml-6 mr-6 text-2xl self-center">
                Oops, aucun achat réaliser ! <a class="underline" href="{{route('dashboardUser.index')}}">Je vais voir
                    les différents livres</a>
            </h2>
        </section>
    @endif
@endsection
