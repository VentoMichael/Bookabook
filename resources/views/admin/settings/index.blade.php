@extends('layouts.app')

@section('content')
    <h2 aria-level="2" class="text-lg">
        Paramètres
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-4">
            <a class="duration-300 w-full rounded-xl mt-2 p-3 border hover:bg-orange-900 hover:text-white"
               href="#">Gérer mon compte</a>
            <form aria-label="Déconnexion" role="form" id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button role="button" class="text-left duration-300 w-full rounded-xl mt-2 p-3 border hover:bg-orange-900 hover:text-white">
                    Déconnexion
                </button>
            </form>
    </div>
    <section class="mt-8">
        <h2 aria-level="2" class="text-lg">
            Aide
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
            <a class="duration-300 w-full rounded-xl p-3 border hover:bg-orange-900 hover:text-white"
               href="{{route('users.index')}}">Voir tous les étudiants</a>
            <a class="duration-300 w-full rounded-xl p-3 border hover:bg-orange-900 hover:text-white"
               href="{{route('books.index')}}">Voir tous les livres</a>
            <a class="duration-300 w-full rounded-xl p-3 border hover:bg-orange-900 hover:text-white"
               href="{{route('purchases.index')}}">Voir les differents achats</a>
        </div>
    </section>
@endsection

