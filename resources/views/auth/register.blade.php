@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body flex">
                        <form aria-label="Enregistrement d'un compte" role="form" method="POST" class="w-full m-3" action="{{ route('register') }}">
                            @csrf

                            <div class="sm:flex sm:justify-between">
                                <div class="form-group row sm:w-5/12 mb-6">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="text-lg form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('name') is-invalid @enderror"
                                               name="name"
                                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row sm:w-5/12 mb-6">
                                    <label for="surname"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                                    <div class="col-md-6">
                                        <input id="surname" type="text"
                                               class="text-lg form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('surname') is-invalid @enderror"
                                               name="surname"
                                               value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                        @error('surname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="sm:flex sm:justify-between">

                                <div class="form-group row sm:w-5/12 mb-6">
                                    <label for="email"
                                           class="text-lg col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('email') is-invalid @enderror"
                                               name="email"
                                               value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row sm:w-5/12 mb-6">
                                    <label for="password"
                                           class="text-lg col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('password') is-invalid @enderror"
                                               name="password"
                                               required autocomplete="new-password">
                                        <ul role="list" class="mt-2">
                                            <li role="listitem" class="text-xs">
                                                Minimum 8 caractères
                                            </li>
                                            <li role="listitem" class="text-xs">
                                                Minimum 1 majuscule
                                            </li>
                                            <li role="listitem" class="text-xs">
                                                Minimum 1 chiffre
                                            </li>
                                        </ul>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <p class="mb-4 text-lg">Je suis dans le groupe :</p>
                                @for ($i = 1; $i < 6; $i++)
                                    <div class="flex justify-between mb-6">
                                        @for ($j = 1; $j <= 3; $j++)
                                            <div>
                                                <input type="radio" name="group" value="2{{ $j }}8{{ $i }}"
                                                       id="2{{ $j }}8{{ $i }}"
                                                       class="form-control @error('group') is-invalid @enderror"
                                                       required
                                                       autocomplete="group"/>
                                                <label for="2{{ $j }}8{{ $i }}">2{{ $j }}8{{ $i }}</label>
                                            </div>
                                        @endfor
                                    </div>
                                @endfor

                                @error('group')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button role="button" type="submit" class="w-full mt-12 rounded-xl block bg-orange-900 text-white p-3">
                                        {{ __('S\'enregistrer') }}
                                    </button>
                                </div>
                            </div>

                            <div class="flex justify-between">
                                @if (Route::has('login'))
                                    <a class="btn btn-link underline mt-6" href="{{ route('login') }}">
                                        J'ai déjà un compte
                                    </a>
                                @endif
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link underline mt-6" href="{{ route('password.request') }}">
                                        J'ai oublié mon mot de passe
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
