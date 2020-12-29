@extends('layouts.app')

@section('content')
    <div class="card mx-6 my-0 mt-12 md:mx-auto md:w-9/12 md:max-w-3xl">
        <div class="card-body">
            <form aria-label="Connexion" role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="sm:flex sm:justify-between">
                    <div class="form-group row sm:w-5/12">
                        <label for="email"
                               class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                   class="rounded-xl p-2 px-3 w-full border border-orange-900 @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong class="alert">{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mt-8 sm:mt-0 sm:w-5/12 relative">
                        <label for="password"
                               class="col-md-4 col-form-label text-md-right">Mot de passe</label>
                        <div class="col-md-6 relative">
                            <input id="password" type="password"
                                   class="rounded-xl p-2 px-3 w-full border border-orange-900 form-control @error('password')is-invalid @enderror"
                                   name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong class="alert">{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div id="showPassBtn" class="cursor-pointer password showPass">Montrer</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div>
                        <button role="button" type="submit"
                                class="mb-2 w-full block rounded-xl block mt-12 bg-orange-900 text-white p-3">
                            Se connecter
                        </button>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">



                                    <div class="rememberCheckbox">
                                        <input class="w-4 h-4 border " type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                        <label
                                            for="remember"
                                            class="form-check-label">
                                            Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            @if (Route::has('register'))
                                <a class="btn btn-link underline mt-6" href="{{ route('register') }}">
                                    S'inscrire
                                </a>
                            @endif
                            @if (Route::has('password.request'))
                                <a class="btn btn-link underline mt-6" href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/password.js') }}"></script>
@endsection
