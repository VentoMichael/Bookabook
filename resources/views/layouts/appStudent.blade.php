<!DOCTYPE html>
@if(!auth())
    <html lang="{{ str_replace('_','-', app()->getLocale()) }}" class="bg-orange-900">
    @endif
    <html lang="fr" class="bg-orange-900 pb-20">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content="Book a book - réservations de livres">
        <meta name="description"
              content="Application dans laquelle des étudiants peuvent réserver des livres a Mr Spirlet"/>
        <meta name="keywords" content="Livres, étudiants, réduction de livres">
        <meta name="language" content="French">
        <meta name="author" content="Vento Michael"/>

        <title>
            @if(Illuminate\Support\Facades\Auth::check())
                {{ 'Book a book' }}
                {{ Request::is('/') ? " | Livres" : "" }}
            @endif
        </title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    </head>
    @if(!auth())
        <body class="bg-white m-3 mb-0 rounded-xl mb-24">

        <div class="flex flex-col sm:max-w-3xl md:m-auto pb-6 justify-between md:w-3/4">
            @endif
            <body class="bg-white m-3 mb-0 rounded-xl pb-2">
            <section>
                <div clawss="inline-block">
                    <h1 aria-level="1" class="ml-3 mt-3 inline-block">
                        <a class="navbar-brand" href="{{ url('/') }}" role="banner">
                            <img class="logo" src="{{asset('svg/logo.svg')}}" alt="Book a book application">
                        </a>
                    </h1>
                    <a class="pictoCart" href="{{route('cart.index')}}"><img class="logo" src="{{asset('svg/cart.svg')}}" alt="Book a book application">
                    </a>
                </div>
                <header>
                    <h2 class="hiddenTitle">
                        Informations d'en tête
                    </h2>
                    <div class="flex flex-col md:flex-row justify-between">
                        @if(Illuminate\Support\Facades\Auth::check())
                            <div id="app" class="flex items-center m-auto">
                                <nav role="navigation" aria-label="Navigation principale"
                                     class="m-auto mt-4 mb-4 navbar navbar-expand-md navbar-light"
                                     role="navigation">
                                    <h2 class="hiddenTitle">
                                        Navigation principale
                                    </h2>
                                    <ul role="list" class="container flex items-center">
                                        <li role="listitem"
                                            aria-current="{{ Request::is('/') ? "page" : "" }}"
                                            class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ Request::is('/') ? "current_page_item" : "" }}">
                                            <a class="text-xl" href="{{route('dashboardUser.index')}}">
                                                Livres
                                            </a>
                                        </li>
                                        <li role="listitem"
                                            aria-current="{{ Request::is('*/purchases/*') || Request::is('*/purchases') ? "page" : "" }}"
                                            class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ Request::is('*/purchases/*') || Request::is('*/purchases') ? "current_page_item" : "" }}">
                                            <a class="text-xl" href="{{route('purchasesUser.index')}}">
                                                Achats
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @endif
                    </div>
                </header>
                <main class="py-4 mr-26 bg-white my-0 mx-3">
                    @yield('content')
                </main>
                @if(Illuminate\Support\Facades\Auth::check())
                    <footer>
                        <h2 class="hiddenTitle">
                            Informations de bas de page
                        </h2>
                        <nav role="navigation" aria-label="Navigation secondaire">
                            <h3 class="hiddenTitle">
                                Navigation secondaires
                            </h3>
                            <ul role=list" class="flex justify-around relative navSecondary">
                                <li role="listitem">
                                    <a class="text-transparent homeSvg" href="{{route('dashboardUser.index')}}">
                                        Home
                                    </a>
                                </li>
                                <li role="listitem">
                                    <a aria-current="{{ Request::is('settings/*') ? "page" : "" }}"
                                       class="text-transparent settingsSvg"
                                       href="{{route('settingsStudent.index')}}">
                                        Paramètres
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </footer>
                @endif
            </section>
            </body>
        </div>
        @yield('scripts')
        </body>
    </html>
