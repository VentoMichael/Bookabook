@extends('layouts.app')
@section('content')
    <h2 aria-level="2" class="hiddenTitle">
        Page d'édition du profil
    </h2>
    @if (Session::has('messageBook'))
        <div id="sucessMessage"
             class="fixed z-10 top-0 bg-green-500 w-full p-4 right-0 text-center text-white">{{ Session::get('messageBook') }}</div>
    @endif
    <section class="mb-10">
        <h2 aria-level="2" class="text-xl mb-2 font-bold">
            Mes informations personnelles
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-12">
            <div>
                <div class="self-center mx-auto userContainer my-4">
                    <img role="img" aria-label="Photo de couverture de {{$user->name}}"
                         src="{{asset('storage')}}/{{$user->file_name ?? 'default.svg'}}"
                         alt="Photo de profil de {{$user->name}}"/>
                </div>
            </div>
            <div class="self-center">
                <div>
                    <p class="mb-2">Mon nom et prénom : </p>
                    <p class="cursor-not-allowed border-b rounded-lg p-3 pb-2 max-w-none">{{$user->name}} {{$user->surname}}</p>
                </div>
                <div class="mt-4">
                    <p class="mb-2">Mon adresse mail : </p>
                    <p class="cursor-not-allowed border-b rounded-lg p-3 pb-2 max-w-none">{{$user->email}}</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <h2 aria-level="2" class="text-lg mb-2 font-bold">
            Editions de mes informations
        </h2>
        <form aria-label="Modification du compte" role="form" class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-12"
              method="POST"
              action="{{route('users.update',['user' => $user->name])}}"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div>
                <label for="file_name" class="label mb-2">Modifier ma photo de profil : </label>
                <input type="file" name="file_name"
                       class="whitespace-normal w-full border rounded-lg p-2 @error('file_name')is danger @enderror input"
                       id="file_name">
                @if($errors->first('file_name'))
                    <p class="text-red-500 text-lg mb-4">
                        {{$errors->first('file_name')}}
                    </p>
                @endif
            </div>

            <div class="field my-4 sm:my-0 flex flex-col sm:self-end sm:mb-0">
                <label for="email" class="label">Modifier mon adresse mail :</label>
                <input id="email" name="email" type="email"
                       class="border rounded-lg p-3 pb-2 input @error('email')is danger @enderror"
                       value="{{$user->email}}">
                @if($errors->first('email'))<p class="text-red-500 text-lg mb-4">{{$errors->first('email')}}</p>@endif
            </div>
                <div class="field my-4 sm:my-0 flex flex-col sm:self-start sm:mb-0">
                    <label for="bank_account" class="label">Mon numéro de compte en banque :</label>
                    <input id="bank_account" name="bank_account" type="text"
                           class="border rounded-lg p-3 pb-2 input @error('bank_account')is danger @enderror"
                           value="BE{{$user->bank_account}}">
                    @if($errors->first('bank_account'))<p
                        class="text-red-500 text-lg mb-4">{{$errors->first('bank_account')}}</p>@endif
                    @if(Auth::user()->is_administrator)
                        @if(!$user->bank_account)
                    <p class="text-sm text-red-500">Référez votre numéro de compte, cela permettra aux étudiants de vous payer</p>
                            @endif
                    @else
                        @if(!$user->bank_account)
                        <p class="text-sm text-red-500">Référez votre numéro de compte, cela aide M. Spirlet à vous identifiez</p>
                        @endif
                    @endif

                </div>
            <div class="field my-2 sm:my-0 flex flex-col sm:self-end sm:mb-0 relative">
                <label for="password" class="label">Mon nouveau mot de passe</label>
                <div class="relative">
                    <input id="password" name="password" type="password"
                           class="border rounded-lg p-3 pb-2 w-full input @error('password')is danger @enderror">
                    @if($errors->first('password'))<p
                        class="text-red-500 text-lg mb-4">{{$errors->first('password')}}</p>@endif
                    <div id="showPassBtn" class="cursor-pointer password showPass">Montrer</div>
                </div>
                <ul role="list" class="mt-2">
                    <li role="listitem" class="text-xs">
                        Minimum 8 caractères
                    </li>
                    <li role="listitem" class="text-xs">
                        Minimum 1 minuscule
                    </li>
                    <li role="listitem" class="text-xs">
                        Minimum 1 majuscule
                    </li>
                    <li role="listitem" class="text-xs">
                        Minimum 1 chiffre
                    </li>
                </ul>
            </div>
            <div class="field my-2 sm:my-0 flex flex-col sm:self-end sm:mb-0 relative">
                <label for="password_confirmation" class="label">Confirmer mon nouveau mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                       class="border rounded-lg p-3 pb-2 input @error('password_confirmation')is danger @enderror">
                @if($errors->first('password_confirmation'))<p
                    class="text-red-500 text-lg mb-4">{{$errors->first('password_confirmation')}}</p>@endif
            </div>
            <div class="field sm:mx-auto sm:w-2/4 sm:col-span-2">
                <button role="button" type="submit" class="w-full rounded-xl mt-6 bg-orange-900 text-white p-3">Mettre à jour mon profil
                </button>
            </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/password.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/successMessage.js') }}"></script>
@endsection
