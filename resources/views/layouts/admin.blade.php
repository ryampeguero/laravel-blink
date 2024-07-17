<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css'
        integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=='
        crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- TomTom API --}}

    <!-- Replace version in the URL with desired library version -->
    <link rel="stylesheet" type="text/css"
        href="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps.css" />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
    <style>
        #map {
            width: 100%;
            height: 80%;
        }
    </style>


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        <header class="ms_navbar ms_backC_primary d-md-none sticky-top bg-dark flex-md-nowrap p-2 ms_shadow">
            {{-- <div class="row justify-content-between">
                <div class="col-8">
                    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/"><img class="h-100"
                            src="{{ asset('Icons/blink-logo-white.svg') }}" alt=""></a>
                    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="navbar-nav col-4">
                    <div class="nav-item text-nowrap ms-2 ">
                        <a class="nav-link ms_t-white" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div> --}}
        </header>

        <div class="container-fluid vh-100 ">
            <div class="row">
                <!-- Definire solo parte del menu di navigazione inizialmente per poi
        aggiungere i link necessari giorno per giorno
        -->
                <nav id="sidebarMenu"
                    class="sidebar_size col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar collapse ms_backC_tertiary vh-100 row ms_shadow3 ">

                    <div class="mt-auto pt-3 h-100">
                        <ul class="nav d-flex flex-column h-100 justify-content-start align-items-center ">

                            <li class="ms_nav_item_logo">

                                <a class="" href="/"><img class="container sidebar_logo me-auto"
                                        src="{{ asset('Icons/blink-logo-white.svg') }}" alt=""></a>
                            </li>

                            <li
                                class="nav-item-li d-flex container-fluid align-items-center nav-link {{ Route::currentRouteName() == 'admin.flats.index' ? 'ms_backC_secondary_selected ' : '' }}">
                                <a class="text-navbar " href="{{ route('admin.flats.index') }}">
                                    <div class="d-flex container-fluid align-items-center">
                                        <img class="icon me-3" src="{{ asset('Icons/HomePage.svg') }}"
                                            alt=""></img><span> HomePage</span>
                                    </div>
                                </a>
                            </li>

                            <li
                                class="  d-flex justify-content-start align-items-center nav-item-li nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'ms_backC_secondary_selected ' : '' }}">
                                <a class="text-navbar" href="{{ route('admin.dashboard') }}">
                                    <div class="d-flex container-fluid align-items-center">
                                        <img class="icon me-3" src="{{ asset('Icons/Dashboard.svg') }}"
                                            alt=""></img><span> Dashboard</span>
                                    </div>
                                </a>
                            </li>

                            <li
                                class="d-flex justify-content-start align-items-center nav-item-li nav-link text-navbar {{ Route::currentRouteName() == 'admin.flats.index' ? 'ms_backC_secondary_selected ' : '' }}">
                                <a class="text-navbar" href="{{ route('admin.flats.index') }}">
                                    <div class="d-flex container-fluid align-items-center ">
                                        <img class="icon me-3" src="{{ asset('Icons/Flats.svg') }}"
                                            alt=""></img><span> Appartementi</span>
                                    </div>
                                </a>
                            </li>

                            <li
                                class="d-flex justify-content-start align-items-center nav-item-li nav-link text-navbar {{ Route::currentRouteName() == 'admin.flats.create' ? 'ms_backC_secondary_selected ' : '' }}">
                                <a class="text-navbar" href="{{ route('admin.flats.create') }}">
                                    <div class="d-flex container-fluid align-items-center ">
                                        <img class="icon me-3" src="{{ asset('Icons/Add.svg') }}"
                                            alt=""></img><span> Crea Appartemento</span>
                                    </div>
                                </a>
                            </li>

                            <li
                                class="d-flex justify-content-start align-items-center nav-item-li mt-auto nav-link text-navbar {{ Route::currentRouteName() == 'admin.logout' ? 'ms_backC_secondary_selected ' : '' }}">
                                <a class="text-navbar" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                                    <img class="icon me-3" src="{{ asset('Icons/exit.svg') }}" alt="">
                                    Esci
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </li>
                        </ul>
                    </div>

                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 overflow-auto vh-100">
                    @yield('content')
                </main>
            </div>

        </div>

    </div>
    <!-- Replace version in the URL with desired library version -->
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.0/maps/maps-web.min.js"></script>
    <script>
        tt.setProductInfo("<your-product-name>", "<your-product-version>")
        tt.map({
            key: "bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26",
            container: "map",
        })
    </script>
</body>

</html>
