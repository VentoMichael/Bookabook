<div class="justify-center flex mb-4 flex-col sm:flex-row sm:mr-8">
    <a class="{{ Route::currentRouteName() === 'books.index' || Route::currentRouteName() === 'books.edit'|| Route::currentRouteName() === 'books.show' ? "bg-orange-900 text-white border-2 border-orange-900 hover:text-white " : "" }}sm:self-center linkAction rounded-xl border-2 border-orange-900 my-4 sm:my-0 w-full hover:bg-orange-900 md:w-64 sm:mx-8 hover:text-white duration-300 px-4 pt-4 pb-4"
       href="{{route('books.index')}}">
        Gérer
    </a>
    <a class="{{ Route::currentRouteName() === 'books.create' ? "bg-orange-900 text-white border-2 border-orange-900 hover:text-white " : "" }}sm:self-center linkAction rounded-xl border-2 border-orange-900 my-4 sm:my-0 w-full hover:bg-orange-900 md:w-64 sm:mx-8 hover:text-white duration-300 px-4 pt-4 pb-4"
       href="{{route('books.create')}}">
        Ajouter
    </a>
    @if($booksDraft->count())
        <a class="{{ Route::currentRouteName() === 'books.draft' ? "bg-orange-900 text-white border-2 border-orange-900 " : "" }}md:w-64 sm:self-center linkAction rounded-xl border-2 border-orange-900 w-full hover:text-white hover:bg-orange-900 duration-300 px-4 pt-4 pb-4"
           href="{{route('books.draft')}}">
            Voir mes sauvegardes de livres
        </a>
    @endif
</div>
