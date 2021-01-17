@extends('layouts.app')
@section('content')
    @if($query !== null)
        @if(count($users))
            <section class="flex flex-col mt-8 mb-32">
                <div
                    class="sm:w-2/4 w-full -mt-6 mb-8 border-2 border-orange-900 inline-block mx-auto text-center rounded-full px-6 py-3">
                    <p class="sm:max-w-none">{{count($users) > 1 || count($books) > 1 ? 'Les resultats' : 'Le resultat'}} pour votre recherche
                        "{{ $query }}" {{count($users) > 1 ? 'sont' : 'est'}}</p>
                </div>
                <h2 aria-level="2" class="mx-auto text-3xl mb-2">Détails
                    sur {{count($users) > 1 ? 'les utilisateurs' : 'l\'utilisateur'}}</h2>
                <div class="-my-2 py-2 overflow-x-auto">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-orange-200">
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-orange-200 bg-orange-50 text-left text-base leading-4 font-medium text-gray-900 tracking-wider">
                                    Nom
                                </th>
                                <th class="px-6 py-3 border-b border-orange-200 bg-orange-50 text-left text-base leading-4 font-medium text-gray-900 tracking-wider">
                                    Groupe
                                </th>
                                <th class="px-6 py-3 border-b border-orange-200 bg-orange-50"><!-- --></th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 border-b border-orange-200">
                                        <div class="flex items-center" itemscope itemtype="https://schema.org/Person">
                                            <div class="flex-shrink-0 h-10 w-10 userSearchContainer">
                                                <div class="userContainer">
                                                    <img role="img" aria-label="Photo de couverture de {{$user->name}}" src="{{asset('storage')}}/{{$user->file_name ?? 'default.svg'}}" alt="Photo de profil de {{$user->name}}"/>
                                                </div>

                                            </div>
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm leading-5 font-medium text-orange-900"><span itemprop="familyName">{{$user->name}}</span> <span itemprop="givenName">{{$user->surname}}</span></div>
                                                <div class="text-sm leading-5 text-gray-900" itemprop="email">{{$user->email}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-orange-200 text-sm leading-5 text-gray-900">{{$user->group}}</td>
                                    <td class="px-6 py-4 text-right border-b border-orange-200 text-sm leading-5 font-medium">
                                        <a href="{{route('users.show',['user'=>$user])}}"
                                           class="text-indigo-600 hover:text-indigo-900">Voir</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        @endif
        @if(count($books))
            <section class="flex flex-col mt-8 mb-32">
                <h2 aria-level="2" class="mx-auto text-3xl mb-2">Détails sur {{count($books) > 1 ? 'les livres' : 'le livre'}}</h2>
                <div class="-my-2 py-2 overflow-x-auto">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-orange-200">
                        @if(count($books))
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-orange-200 bg-orange-50 text-left text-base leading-4 font-medium text-gray-900 tracking-wider">
                                        Titre
                                    </th>
                                    <th class="px-6 py-3 border-b border-orange-200 bg-orange-50 text-left text-base leading-4 font-medium text-gray-900 tracking-wider">
                                        Maison d'édition
                                    </th>
                                    <th class="px-6 py-3 border-b border-orange-200 bg-orange-50 text-left text-base leading-4 font-medium text-gray-900 tracking-wider">
                                        Prix
                                    </th>
                                    <th class="px-6 py-3 border-b border-orange-200 bg-orange-50 text-left text-base leading-4 font-medium text-gray-900 tracking-wider">
                                        Présentation
                                    </th>
                                    <th class="px-6 py-3 border-b border-orange-200 bg-orange-50 text-left text-base leading-4 font-medium text-gray-900 tracking-wider">
                                        Stock
                                    </th>
                                    <th class="px-6 py-3 border-b border-orange-200 bg-orange-50"><!-- --></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                @foreach($books as $bookDetails)
                                    <tr>
                                        <td class="px-6 py-4 border-b border-orange-200">
                                            <div class="flex items-center" itemscope itemtype="https://schema.org/Book">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img itemprop="illustrator" role="img" aria-label="Photo de couverture de {{$bookDetails->title}}" src="{{ asset('storage/'.$bookDetails->picture) }}"
                                                         alt="Photo de couverture de {{$bookDetails->title}}">
                                                </div>
                                                <div class="ml-4">
                                                    <div
                                                        class="text-sm leading-5 font-medium text-orange-900">{{$bookDetails->title}}</div>
                                                    <div
                                                        class="text-sm leading-5 text-gray-900">{{$bookDetails->author}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 border-b border-orange-200">
                                            <div class="ml-4">
                                                <div itemprop="name"
                                                    class="text-sm leading-5 font-medium text-gray-900">{{$bookDetails->publishing_house}}</div>
                                                <div itemprop="bookEdition"
                                                    class="text-sm leading-5 text-gray-900">{{$bookDetails->isbn}}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 border-b border-orange-200">
                                            <div class="ml-4">
                                                <div
                                                    class="text-xl leading-5 text-gray-900">{{$bookDetails->proposed_price}}</div>
                                                <div
                                                    class="text-sm leading-5 line-through font-medium text-gray-900">
                                                    <p>{{$bookDetails->public_price}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td itemprop="isbn" class="px-6 py-4 border-b border-orange-200 text-sm leading-5 text-gray-900">{{$bookDetails->presentation}}</td>
                                        <td class="px-6 py-4 border-b border-orange-200 text-sm leading-5 text-gray-900">{{$bookDetails->stock}}</td>

                                        <td class="px-6 py-4 text-right border-b border-orange-200 text-sm leading-5 font-medium">
                                            <a class="text-indigo-600 hover:text-indigo-900"
                                               href="{{route('books.show',['book'=>$bookDetails->title])}}">Voir</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    @endif
@endsection
