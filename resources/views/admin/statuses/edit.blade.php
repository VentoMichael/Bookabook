@extends('layouts.app')

@section('content')
    <form role="form" method="POST" aria-label="Édition du statut" class="sm:gap-12 sm:grid sm:grid-cols-2"
          action="{{ route('users.show',['user'=>$user->name]) }}">
        @csrf
        @method('PUT')
        <div class="field flex mt-8 flex-col">
            <label for="status" class="label mb-2">Status</label>
            <select name="status"
                    class="bg-white border rounded-lg p-3 minimal input @error('orientation')is danger @enderror"
                    id="status">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->nameFr }}</option>
                @endforeach
            </select>
            <p class="text-red-500 text-lg mb-4"></p>
        </div>
        <button role="button"
                class="mx-auto max-w-2xl duration-300 col-span-2 w-full rounded-xl mt-6 p-3 border hover:bg-orange-900 hover:text-white"
                type="submit">
            Mettre à jour
        </button>
    </form>
@endsection
