<!DOCTYPE html>
    <html lang="fr" class="bg-orange-900">
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
            @auth
                @if(Auth::user()->is_administrator)
                    {{'Admin | '}}{{ 'Book a book' }}
                    {{ Request::is('*/users/*') || Request::is('*/users') || Request::is('*/dashboard') ? " | Étudiants" : "" }}
                    {{ Request::is('*/books/*') || Request::is('*/books') ? " | Livres" : "" }}
                @else
                    {{ 'Book a book' }}
                    {{ Request::is('/') ? " | Livres" : "" }}
                    {{ Request::is('users/*') ? " | Profil" : "" }}
                @endif
                {{ Request::is('purchases/*') || Request::is('purchases') ? " | Achats" : "" }}
                {{ Request::is('*/settings') || Request::is('settings') ? " | Paramètres" : "" }}
            @endauth
        </title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    </head>
    @if(!auth())
        <body class="bg-white m-3 mb-0 rounded-xl mb-24 min-h-full -mb-4">
        <div class="flex flex-col sm:max-w-3xl md:m-auto pb-6 justify-between md:w-3/4">
            @endif
            <body class="bg-white m-3 mb-0 rounded-xl min-h-full relative pb-24">
            <section class="pb-12">
                <div clawss="inline-block">
                    <h1 aria-level="1" class="ml-3 mt-3 inline-block">
                        @auth
                            @if(Auth::user()->is_administrator)
                                <a class="navbar-brand" href="{{ url('/admin') }}" role="banner">
                                    <img class="logo" src="{{asset('svg/logo.svg')}}" alt="Book a book application">
                                </a>
                            @else
                                <a class="navbar-brand" href="{{ url('/') }}" role="banner">
                                    <img class="logo" src="{{asset('svg/logo.svg')}}" alt="Book a book application">
                                </a>
                            @endif
                        @else
                            <a class="navbar-brand" href="{{ url('/') }}" role="banner">
                                <img class="logo" src="{{asset('svg/logo.svg')}}" alt="Book a book application">
                            </a>
                        @endauth
                    </h1>
                    @auth
                        @if(!Auth::user()->isAdministrator)
                            <a class="pictoCart" href="{{route('cart.index')}}">
                                <img class="logo" src="{{asset('svg/cart.svg')}}" alt="Book a book application">
                            </a>
                        @endif
                    @endauth
                </div>
                <header>
                    <h2 class="hiddenTitle">
                        Informations d'en tête
                    </h2>
                    <div class="flex flex-col md:flex-row justify-between">
                        @auth
                            <div id="app" class="flex items-center m-auto">
                                <nav role="navigation" aria-label="Navigation principale"
                                     class="m-auto mt-4 mb-4 navbar navbar-expand-md navbar-light"
                                     role="navigation">
                                    <h2 class="hiddenTitle">
                                        Navigation principale</h2>
                                    <ul role="list" class="container flex items-center">
                                        @if(Auth::user()->isAdministrator)
                                            <li role="listitem"
                                                aria-current="{{ \Route::current()->getName() === 'users.index' || \Route::current()->getName() === 'users.show' || \Route::current()->getName() === 'users.edit' || \Route::current()->getName() === 'users.suspended' ? "page" : "" }}"
                                                class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ \Route::current()->getName() === 'users.index' || \Route::current()->getName() === 'users.show' || \Route::current()->getName() === 'users.edit' || \Route::current()->getName() === 'users.suspended' ? "current_page_item" : "" }}">
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
                                        @else
                                            <li role="listitem"
                                                aria-current="{{ Request::is('/') ? "page" : "" }}"
                                                class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ Request::is('/') ? "current_page_item" : "" }}">
                                                <a class="text-xl" href="{{route('dashboardUser.index')}}">
                                                    Livres
                                                </a>
                                            </li>
                                            <li role="listitem"
                                                aria-current="{{ Request::is('*/purchases/*') || Request::is('purchases') ? "page" : "" }}"
                                                class="m-3 my-0 duration-300 opacity-25 hover:opacity-100 {{ Request::is('*/purchases/*') || Request::is('purchases') ? "current_page_item" : "" }}">
                                                <a class="text-xl" href="{{route('purchasesUser.index')}}">
                                                    Achats
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                            @if(Auth::user()->isAdministrator)
                                <form role="search" action="/admin/search" aria-label="informations à chercher"
                                      class="z-0 absolute top-0 right-0 sm:w-1/4 mt-6 mr-6 containerSearch"
                                      method="get">
                                    @csrf
                                    <label for="search" class="hidden">Chercher dans l'application :</label>
                                    <input type="search" id="search"
                                           class="searchInput rounded-xl h-12 w-full border-2 border-orange-900 containerSearch p-2 bg-transparent"
                                           name="search" required
                                           placeholder="Livres ou étudiants"
                                           aria-label="Search through site content">
                                    <input class="hidden" type="submit">
                                    <div class="submitDiv absolute top-0 right-0">
                                    </div>
                                </form>
                            @endif
                        @endauth
                    </div>
                </header>
                <main class="h-full py-4 mr-26 bg-white my-0 mx-3">
                    @yield('content')
                </main>
                @if(Illuminate\Support\Facades\Auth::check())
                    <footer class="py-6 bg-orange-900">
                        <h2 class="hiddenTitle">
                            Informations de bas de page
                        </h2>
                        <nav role="navigation" aria-label="Navigation secondaire">
                            <h3 class="hiddenTitle">
                                Navigation secondaires
                            </h3>
                            <ul role=list" class="flex justify-around">
                                @if(Auth::user()->isAdministrator)
                                    <li role="listitem">
                                        <a class="text-transparent homeSvg" href="{{route('users.index')}}">
                                            Home
                                        </a>
                                    </li>
                                    <li role="listitem">
                                        <a aria-current="{{ Request::is('settings/*') ? "page" : "" }}"
                                           class="text-transparent settingsSvg"
                                           href="{{route('settings.index')}}">
                                            Paramètres
                                        </a>
                                    </li>
                                @else
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
                                @endif
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
