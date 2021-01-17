@extends('layouts.app')

@section('content')
    <div class="relative">
        @if($booksDraft)
            <a class="backLink text-transparent text-xl relative text-2xl" title="Retour en arrière"
               href="{{route('books.draft')}}">Retour
                en arrière</a>
        @else
            <a class="backLink text-transparent text-xl relative text-2xl" title="Retour en arrière"
               href="{{route('books.index')}}">Retour
                en arrière</a>
        @endif

        @if (Session::has('message'))
            <div id="sucessMessage"
                 class="fixed z-10 top-0 bg-green-500 w-full p-4 right-0 text-center text-white">{{ Session::get('message') }}</div>
        @endif
        @include('partials.cta-menu')
        <section>
            <h2 aria-level="2" class="hiddenTitle">
                Informations du livre {{$book->title}}
            </h2>
            <ul role="list" class="sm:flex sm:mx-auto lg:max-w-screen-lg" itemscope=""
                itemtype="https://schema.org/Book">
                <li class="sm:w-2/5">
                    <ul class="sm:sticky containerImgBook sm:mr-8 sm:mb-12">
                        <li role="listitem" class=" justify-center my-12 sm:block mx-auto">
                            <img class="mx-auto" itemprop="illustrator" role="img"
                                 aria-label="Photo de couverture de {{$book->title}}"
                                 src="{{ asset('storage/'.$book->picture) }}"
                                 alt="Photo de couverture de {{$book->title}}">
                        </li>
                        <li role="listitem" class="my-2 text-xl self-center my-12 flex flex-col">
                            Titre : <span itemprop="name" class="border p-3 rounded-md">{{$book->title}}</span>
                        </li>
                    </ul>
                </li>
                <li class="sm:w-3/5">
                    <ul>
                        <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                            Auteur(s) : <span class="border p-3 rounded-md">{{$book->author}}</span>
                        </li>
                        <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                            Orientation : <span class="border p-3 rounded-md">{{$book->orientation}}</span>
                        </li>
                        <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                            Maison d'édition : <span itemprop="bookEdition"
                                                     class="border p-3 rounded-md">{{$book->publishing_house}}</span>
                        </li>
                        <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                            ISBN : <span itemprop="isbn" class="border p-3 rounded-md">{{$book->isbn}}</span>
                        </li>
                        @if($book->presentation)
                            <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                                Présentation : <span itemprop="description"
                                                     class="border p-3 rounded-md">{{$book->presentation}}</span>
                            </li>
                        @endif
                        <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                            Prix public : <span class="border p-3 rounded-md">{{$book->public_price}} €</span>
                        </li>
                        <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                            Prix proposé : <span class="border p-3 rounded-md">{{$book->proposed_price}} €</span>
                        </li>
                        <li role="listitem" class="my-2 text-xl my-12 flex flex-col">
                            Stock : <span class="border p-3 rounded-md">{{$book->stock}}</span>
                        </li>
                    </ul>
                </li>

            </ul>
        </section>
        <div class="flex justify-evenly sm:mt-4">
            @if($book->is_draft)
                <form class="mt-4 sm:mt-0 sm:mb-0 sm:w-1/3" aria-label="Publication du livre {{$book->title}}"
                      role="form" method="POST"
                      action="/admin/books/{{$book->title}}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <button role="button" name="publish"
                            class="duration-300 p-3 inline hover:bg-orange-900 hover:text-white w-full rounded-xl border-2 border-orange-900 block p-3">
                        Publié {{$book->title}}
                    </button>
                </form>
            @else
                <div class="sm:w-1/3">
                    <a class="w-full text-center block rounded-xl border duration-300 p-3 hover:bg-orange-900 hover:text-white"
                       href="{{route('books.edit',['book'=>$book->title])}}">Éditer
                        <span>{{$book->title}}</span></a>
                </div>
            @endif
            <form class="mt-4 sm:mt-0 sm:w-1/3" role="form" aria-label="Suppression du livre {{$book->title}}"
                  method='POST'
                  action="{{ route('books.destroy',$book) }}">
                @csrf
                @method('DELETE')
                <input type="submit"
                       onclick="return confirm('Cette action ne peut pas être annulée. Cela supprimera définitivement le livre et les commandes liés. Étes-vous sûr de supprimer le livre suivant : {{$book->title}}')"
                       class="cursor-pointer duration-300 p-3 inline bg-orange-900 w-full rounded-xl border-2 text-white border-orange-900 block p-3"
                       value="Supprimer {{$book->title}}"/>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
