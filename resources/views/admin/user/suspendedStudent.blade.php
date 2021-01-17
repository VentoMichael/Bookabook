@extends('layouts.app')

@section('content')

    @if(count($studentSuspended))
        <h2 aria-level="2" class="hiddenTitle">
            Les étudiants de l'application
        </h2>
        <div class="justify-center flex mb-4 flex-col sm:flex-row sm:mr-8">
            @if($users->count() > 0)
                <a class="{{ Route::currentRouteName() === 'users.index' ? "bg-orange-900 text-white border-2 border-orange-900 " : "" }}md:w-64 mx-4 sm:self-center linkAction rounded-xl border-2 border-orange-900 w-full hover:text-white hover:bg-orange-900 duration-300 px-4 pt-4 pb-4"
                   href="{{route('users.index')}}">
                    @if($users->count() === 1)
                        Voir l'étudiant non suspendus
                    @else
                        Voir les étudiants non suspendus
                    @endif
                </a>
            @endif
            @if($studentSuspended->count() > 0)
                <a class="{{ Route::currentRouteName() === 'users.suspended' ? "bg-orange-900 text-white border-2 border-orange-900 " : "" }}md:w-64 mx-4 sm:self-center linkAction rounded-xl border-2 border-orange-900 w-full hover:text-white hover:bg-orange-900 duration-300 px-4 pt-4 pb-4"
                   href="{{route('users.suspended')}}">
                    @if($studentSuspended->count() === 1)
                        Voir l'étudiant suspendus
                    @else
                        Voir les étudiants suspendus
                    @endif
                </a>
            @endif
        </div>
        @foreach($letters as $key=>$letter)
            <p class="text-5xl block border-t mt-16 -mb-4">{{$key}}</p>
            <div id="{{$key}}"
                 class="grid mt-12 grid-cols-1 md:grid-cols-2 md:mr-8 lg:grid-cols-3 ml-4 flex-wrap justify-between gap-12 mr-4">
                @foreach($letter as $ss)
                    <section
                        class="flex flex-col justify-between border-2 rounded-xl p-4 self-start">
                        @if($ss->suspended === 1)
                            <p class="text-red-700 mb-4 text-xl mx-auto opacity-100">
                                {{$ss->name}} {{$ss->surname}} est suspendu
                            </p>
                        @endif
                        <div class="@if($ss->suspended === 1) opacity-50 @endif">
                            <div class="flex justify-between">
                                <div
                                    class="my-4 flex flex-col rounded-xl mr-2 bg-orange-900 p-4 pt-3 relative justify-around text-center">
                                    <div class="containerBookSvg mb-4 self-center"></div>
                                    @if(count($ss->orders) >= 1)
                                        <p class="break-all text-xl text-white font-hairline">{{$totalbooks}}</p>
                                    @else
                                        <p class="text-xl text-white font-hairline">0</p>
                                    @endif
                                </div>
                                <div
                                    class="my-4 rounded-xl bg-orange-900 p-3 pt-3 relative justify-around text-center">
                                    <div class="containerGroupSvg mb-2 m-auto"></div>
                                    <p class="text-xl text-white font-hairline">{{$ss->group}}</p>
                                </div>
                                <div class="containerUserAvatars ml-2">
                                    <div class="userContainer">
                                        <img role="img" class="rounded-lg"
                                             aria-label="Photo de couverture de {{$ss->name}}"
                                             src="{{asset('storage')}}/{{$ss->file_name ?? 'default.svg'}}"
                                             alt="Photo de profil de {{$ss->name}}"/>
                                    </div>

                                </div>
                            </div>
                            <div>
                                <h3 aria-level="3" class="text-2xl">
                                    {{$ss->name}} {{$ss->surname}}
                                </h3>
                                <div class="mb-4">
                                    <a href="mailto:{{$ss->email}}">{{$ss->email}}</a>
                                </div>
                            </div>
                            <div>
                                @if(count($ss->orders) >= 1)
                                    @foreach($statuses as $status)
                                        <div>
                                            <p>La commande n°{{$loop->iteration}}</p>
                                        </div>
                                        <div class="flex align-center justify-center my-4 containerStatusName">
                                            <img class="mr-4" src="{{asset('storage').'/orders/'.($status->file_name)}}"
                                                 alt="{{$status->name}} picto">
                                            <p class="pictoOrder text-xl my-4 text-center">{{$status->nameFr}}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <div>
                                <a class="rounded-xl block mt-8 bg-orange-900 text-white p-3"
                                   href="{{route('users.show',['user'=>$ss->name])}}">Plus d'informations sur
                                    <span>{{$ss->name}}</span></a>
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>
        @endforeach
    @else
        <section class="max-w-5xl m-auto md:flex mt-12 sm:mt-16">
            <img class="pictoSadSmiley mx-auto mb-6 md:max-w-sm" src="{{asset('svg/sad.svg')}}"
                 alt="Pictogramme d'un smiley triste">
            <h2 aria-level="2" class="ml-6 mr-6 text-2xl self-center">
                Oops, aucun étudiant @if($studentSuspended) non suspendu ! @else trouver @endif
            </h2>
        </section>
    @endif
    <nav role="navigation" aria-label="Navigation pour accéder à des utilisateurs en particuliers">
        <h2 class="hiddenTitle">
            Navigation pour utilisateurs
        </h2>
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
