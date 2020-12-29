@extends('layouts.app')

@section('content')
    <div class="container md:mx-auto md:w-9/12 md:max-w-3xl"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-xl font-bold mb-6">Réinitialisation du mot de passe</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form aria-label="Mot de passe oublié" role="form" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control rounded-xl p-2 px-3 w-full border border-orange-900 @error('email')is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button role="button" type="submit"
                                            class="w-full mt-12 rounded-xl block bg-orange-900 text-white p-3">
                                        Envoyé un mail de réinitialisation
                                    </button>
                                </div>
                            </div>
                            <div class="flex justify-between">
                                @if (Route::has('login'))
                                    <a class="btn btn-link underline mt-6" href="{{ route('login') }}">
                                        J'ai déjà un compte
                                    </a>
                                @endif
                                @if (Route::has('register'))
                                    <a class="btn btn-link underline mt-6" href="{{ route('register') }}">
                                        Je m'inscris
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
