<!DOCTYPE html>
@if(!auth())
    <html lang="fr" class="bg-orange-900">
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

        <title>@auth()
                @if(Auth::user()->is_administrator)
                    {{'Admin |'}}
                @endif
            @endauth{{ 'Book a book' }}
            {{ Request::is('*/users/*') || Request::is('*/users') || Request::is('*/dashboard') ? " | Étudiants" : "" }}
            {{ Request::is('*/books/*') || Request::is('*/books') ? " | Livres" : "" }}
            {{ Request::is('*/purchases/*') || Request::is('*/purchases') ? " | Achats" : "" }}
            {{ Request::is('*/settings') ? " | Paramètres" : "" }}
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
                <div class="inline-block">
                    <h1 aria-level="1" class="ml-3 mt-3 inline-block">
                        <a class="navbar-brand" href="{{ url('/admin') }}" role="banner">
                            <img class="logo" src="{{asset('svg/logo.svg')}}" alt="Book a book application">
                        </a>
                    </h1>
                </div>
                <header>
                    <h2 class="hiddenTitle">
                        Informations d'en tête
                    </h2>

                    <div class="flex flex-col md:flex-row justify-between">
                        @if (Illuminate\Support\Facades\Auth::check())
                            <div id="app" class="flex items-center m-auto">
                                <nav role="navigation" aria-label="Navigation principale"
                                     class="m-auto mt-4 mb-4 navbar navbar-expand-md navbar-light" role="navigation">
                                    <h2 class="hiddenTitle">
                                        Navigation principale
                                    </h2>
                                    <ul role="list" class="container flex items-center">
                                        <li role="listitem"
                                            aria-current="{{ Request::is('*/users/*') || Request::is('*/users') || Request::is('*/dashboard') ? "page" : "" }}"
                                            class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ Request::is('*/users/*') || Request::is('*/users') || Request::is('*/dashboard') ? "current_page_item" : "" }}">
                                            <a class="text-xl" href="{{route('users.index')}}">
                                                Étudiants
                                            </a>
                                        </li>
                                        <li role="listitem"
                                            aria-current="{{ Request::is('*/books/*') || Request::is('*/books') ? "page" : "" }}"
                                            class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ Request::is('*/books/*') || Request::is('*/books') ? "current_page_item" : "" }}">
                                            <a class="text-xl" href="{{route('books.index')}}">
                                                Livres
                                            </a>
                                        </li>
                                        <li role="listitem"
                                            aria-current="{{ Request::is('*/purchases/*') || Request::is('*/purchases') ? "page" : "" }}"
                                            class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ Request::is('*/purchases/*') || Request::is('*/purchases') ? "current_page_item" : "" }}">
                                            <a class="text-xl" href="{{route('purchases.index')}}">
                                                Achats
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <form role="search" action="/admin/search" aria-label="informations à chercher"
                                      class="z-0 absolute top-0 right-0 mt-6 mr-6" method="get">
                                    @csrf
                                    <label for="formSearch" class="hidden">Chercher dans l'application :</label>
                                    <input type="search" id="formSearch"
                                           class="searchInput rounded-xl border-2 border-orange-900 w-12 h-12 p-1 bg-transparent"
                                           name="search" required
                                           placeholder="Livres ou étudiants"
                                           aria-label="Search through site content">
                                    <input class="hidden" type="submit">
                                    <div class="submitDiv absolute top-0 right-0">
                                    </div>
                                </form>
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
                                Navigation secondaire
                            </h3>
                            <ul role=list" class="flex justify-around relative navSecondary">
                                <li role="listitem">
                                    <a class="text-transparent homeSvg" href="{{route('dashboard.index')}}">
                                        Home
                                    </a>
                                </li>
                                <li role="listitem">
                                    <a aria-current="{{ Request::is('settings/*') ? "page" : "" }}"
                                       class="text-transparent settingsSvg" href="{{route(('settings.index'))}}">
                                        Paramètres
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </footer>
                @endif
            </section>
            </body>
            @if(!auth())
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
        </body>
    @endif
    </html>
