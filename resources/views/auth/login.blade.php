@extends('layouts.app')

@section('content')
        @if(Session::has('messageBanned'))
            <div id="sucessMessage"
                 class="fixed top-0 bg-red-500 w-full p-4 right-0 text-center text-white">{{ Session::get('messageBanned') }}</div>
        @endif
    <div class="mx-6 my-0 mt-12 md:mx-auto md:w-9/12 md:max-w-3xl">
        <div>
            <form aria-label="Connexion" role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="sm:flex sm:justify-between">
                    <div class="row sm:w-5/12">
                        <label for="email"
                               >Email</label>
                        <div>
                            <input id="email" type="email"
                                   class="rounded-xl p-2 px-3 w-full border border-orange-900 @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email"
                                   autofocus>
                            @error('email')
                            <span role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:w-5/12 relative">
                        <label for="password"
                               >Mot de passe</label>
                        <div class="relative">
                            <input id="password" type="password"
                                   class="rounded-xl p-2 px-3 w-full border border-orange-900 form-control @error('password')is-invalid @enderror"
                                   name="password" required autocomplete="current-password">
                            @error('password')
                            <span role="alert">
                                        <strong>{{ $message }}</strong>
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
                            <div>
                                <div>
                                    <div class="rememberCheckbox">
                                        <input class="w-4 h-4 border" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                        <label
                                            for="remember"
                                            >
                                            Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            @if (Route::has('register'))
                                <a class="underline mt-6" href="{{ route('register') }}">
                                    S'inscrire
                                </a>
                            @endif
                            @if (Route::has('password.request'))
                                <a class="underline mt-6" href="{{ route('password.request') }}">
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
