@extends('layouts.app')
@section('content')
    <div class="mt-4">
        <div class="flex flex-wrap -mx-6 justify-around mb-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div
                    class="border-orange-900 border-b-2 border-t-2 rounded-lg flex items-center px-5 py-6 rounded-md bg-white justify-center">
                    <div class="p-3 rounded-full bg-orange-900 bg-opacity-100">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 28 30" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                fill="currentColor"/>
                            <path
                                d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                fill="currentColor"/>
                            <path
                                d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                fill="currentColor"/>
                            <path
                                d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                fill="currentColor"/>
                            <path
                                d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                fill="currentColor"/>
                            <path
                                d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999v22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                fill="currentColor"/>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <p class="text-2xl font-semibold text-gray-900">{{$users->count()}}</p>
                        <div class="text-gray-900">Utilisateurs totaux</div>
                    </div>
                </div>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                <div
                    class="border-orange-900 border-b-2 border-t-2 rounded-lg flex items-center px-5 py-6 rounded-md bg-white justify-center">
                    <div class="p-3 rounded-full bg-orange-900 bg-opacity-100">
                        <svg class="h-8 w-8 text-white" viewBox="0 0 28 28" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99998 11.2H21L22.4 23.8H5.59998L6.99998 11.2Z" fill="currentColor"
                                  stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                            <path
                                d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z"
                                stroke="currentColor" stroke-width="2"/>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <p class="text-2xl font-semibold text-gray-900">{{$orders->count()}}</p>
                        <div class="text-gray-900">Commandes totales</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($users))
        <h2 aria-level="2" class="hiddenTitle">
            Les étudiants de l'application
        </h2>
        <div class="justify-center flex mb-4 flex-col sm:flex-row sm:mr-8">
            @if($studentSuspended->count() > 0)
                @if($users->count() > 0)
                    <a class="{{ Route::currentRouteName() === 'users.index' ? "bg-orange-900 text-white border-2 border-orange-900 " : "" }}md:w-64 mx-4 sm:self-center linkAction rounded-xl border-2 border-orange-900 w-full hover:text-white hover:bg-orange-900 duration-300 px-4 pt-4 pb-4"
                       href="{{route('users.index')}}">
                        @if($studentSuspended->count() === 1)
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
            @endif
        </div>
        @foreach($letters as $key=>$letter)
            <section>
            <h3 aria-level="3" class="text-5xl block border-t mt-16 -mb-4"><span class="hiddenTitle">Les étudiants commençant par </span>{{$key}}</h3>
            <div id="{{$key}}"
                 class="grid mt-12 grid-cols-1 md:grid-cols-2 md:mr-8 lg:grid-cols-3 ml-4 flex-wrap justify-between gap-12 mr-4">
                @foreach($letter as $user)
                    <section
                        class="flex flex-col justify-between border-2 rounded-xl p-4 self-start">
                        @if($user->suspended === 1)
                            <p class="text-red-700 text-xl mx-auto opacity-100">
                                {{$user->name}} {{$user->surname}} est suspendu
                            </p>
                        @endif
                        <div class="@if($user->suspended === 1) opacity-50 @endif">
                            <div class="flex justify-between">
                                <div
                                    class="my-4 flex flex-col rounded-xl mr-2 bg-orange-900 p-4 pt-3 relative justify-around text-center">
                                    <div class="containerBookSvg mb-4 self-center"></div>
                                    @if(count($user->orders) >= 1)
                                        <p class="break-all text-xl text-white font-hairline">{{$totalbooks}}</p>
                                    @else
                                        <p class="text-xl text-white font-hairline">0</p>
                                    @endif
                                </div>
                                <div
                                    class="my-4 rounded-xl bg-orange-900 p-3 pt-3 relative justify-around text-center">
                                    <div class="containerGroupSvg mb-2 m-auto"></div>
                                    <p class="text-xl text-white font-hairline">{{$user->group}}</p>
                                </div>
                                <div class="containerUserAvatars ml-2">
                                    <div class="userContainer">
                                        <img role="img" class="rounded-lg"
                                             aria-label="Photo de couverture de {{$user->name}}"
                                             src="{{asset('storage')}}/{{$user->file_name ?? 'default.svg'}}"
                                             alt="Photo de profil de {{$user->name}}"/>
                                    </div>

                                </div>
                            </div>
                            <div>
                                <h4 aria-level="4" class="text-2xl">
                                    {{$user->name}} {{$user->surname}}
                                </h4>
                                <div class="mb-4">
                                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                </div>
                            </div>
                            <div>
                                @if(count($user->orders) >= 1)
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
                                   href="{{route('users.show',['user'=>$user->name])}}">Plus d'informations sur
                                    <span>{{$user->name}}</span></a>
                            </div>
                        </div>
                    </section>
                @endforeach
            </div>
            </section>
        @endforeach
    @else
        <p>
            Aucun étudiant trouvé
        </p>
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
