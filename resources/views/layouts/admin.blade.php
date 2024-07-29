<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Blink</title>

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

        <header class="d-lg-none  sticky-bottom flex-md-wrap ms_shadow">
            <div class="px-3 py-2 ms_backC_tertiary border-bottom">
                <div class="container-fluid " id="header_top">
                    <div class="row justify-content-lg-start extern_container">
                        <div class="col-2 logo_container">
                            <a href="/"
                                class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                                <img class="logo_blink" src="{{ asset('Icons/blink-ico.svg') }}" alt="">
                            </a>
                        </div>
                        <div class="col-xs-12  col-sm-8 p-0">
                            <ul id="header_sidebar" class="sidebar_header p-0">

                                <li class="">
                                    <a class="text-navbar " href="{{ url('http://localhost:5174/') }}">
                                        <div class="d-flex container-fluid align-items-center">
                                            <img class="icon" src="{{ asset('Icons/HomePage.svg') }}"
                                                alt=""></img>
                                        </div>
                                    </a>
                                </li>

                                <li
                                    class="m-2 ms_border_inner p-3 {{ Route::currentRouteName() == 'admin.dashboard' ? 'ms_backC_secondary_selected ' : '' }}">
                                    <a class="text-navbar" href="{{ route('admin.dashboard') }}">
                                        <div class="d-flex align-items-center">
                                            <img class="icon {{ Route::currentRouteName() == 'admin.dashboard' ? 'filter_white ' : '' }}"
                                                src="{{ asset('Icons/Dashboard.svg') }}" alt=""></img>
                                        </div>
                                    </a>
                                </li>

                                <li
                                    class="m-2 ms_border_inner p-3 {{ Route::currentRouteName() == 'admin.flats.index' ? 'ms_backC_secondary_selected ' : '' }}">
                                    <a class="text-navbar" href="{{ route('admin.flats.index') }}">
                                        <div class="d-flex align-items-center">
                                            <img class="icon {{ Route::currentRouteName() == 'admin.flats.index' ? 'filter_white ' : '' }}"
                                                src="{{ asset('Icons/Flats.svg') }}" alt=""></img>
                                        </div>
                                    </a>
                                </li>

                                <li
                                    class="m-2 ms_border_inner p-3 {{ Route::currentRouteName() == 'admin.flats.create' ? 'ms_backC_secondary_selected ' : '' }}">
                                    <a class="text-navbar" href="{{ route('admin.flats.create') }}">
                                        <div class="d-flex align-items-center ">
                                            <img class="icon {{ Route::currentRouteName() == 'admin.flats.create' ? 'filter_white ' : '' }}"
                                                src="{{ asset('Icons/Add.svg') }}" alt=""></img>
                                        </div>
                                    </a>
                                </li>

                                <li
                                    class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none logout_button_header">
                                    <div id="logout"
                                        class="ms_border_inner {{ Route::currentRouteName() == 'admin.logout' ? 'ms_backC_secondary_selected ' : '' }}">
                                        <a class="text-navbar" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <img class="icon filter_white" src="{{ asset('Icons/exit.svg') }}" alt="">
                                        </a>
        
                                        <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                                            @csrf
                                            @method('GET')
                                        </form>
        
                                    </div>
                                </li>

                            </ul>


                        </div>

                        <div
                            class="col-2 d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none logout_container">
                            <div id="logout"
                                class="ms_border_inner p-3 {{ Route::currentRouteName() == 'admin.logout' ? 'ms_backC_secondary_selected ' : '' }}">
                                <a class="text-navbar" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <img class="icon filter_white" src="{{ asset('Icons/exit.svg') }}" alt="">
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                                    @csrf
                                    @method('GET')
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid vh-100">
            <div class="row">
                <!-- Definire solo parte del menu di navigazione inizialmente per poi
        <-- aggiungere i link necessari giorno per giorno -->

                {{-- sidebarSin --}}
                <div class="d-none d-lg-block col-lg-3  ms_shadow3">
                    <nav id="sidebarMenu" class="sidebar_size ms_backC_tertiary vh-100 ">

                        <div class=" pt-3 h-100">
                            <ul class="d-flex flex-column h-100 justify-content-start align-items-center p-0">

                                <li class="d-flex align-items-center navbar-nav justify-content-start">
                                    <img class="logo_blink" src="{{ asset('Icons/blink-logo-white.svg') }}"
                                        alt="">
                                </li>

                                <li class="mt-3  d-flex justify-content-start align-items-center nav-item-li">
                                    <a class="text-navbar " href="{{ url('http://localhost:5174/') }}">
                                        <div class="d-flex container-fluid align-items-center">
                                            <img class="icon me-3" src="{{ asset('Icons/HomePage.svg') }}"
                                                alt=""></img><span> HomePage</span>
                                        </div>
                                    </a>
                                </li>

                                <li
                                    class=" d-flex justify-content-start align-items-center nav-item-li nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'ms_backC_secondary_selected ' : '' }}">
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
                                                alt=""></img><span> Appartamenti</span>
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

                                {{-- user avatar --}}
                                <li class="d-flex mt-auto justify-content-start nav-item-li">
                                    <div class="d-flex align-items-start ms-2">
                                        <div class="d-flex align-items-start">
                                            @if ($user->img_path)
                                                <img class="icon_profile"
                                                    src="{{ asset('storage/' . $user->img_path) }}" alt="...">
                                            @else
                                                <img class="icon_profile"
                                                    src="{{ asset('img/user_placeholder.png') }}" alt="">
                                            @endif
                                            <div class="p-2 text-dark">
                                                Ciao, {{ ucwords($user->name) }}
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li
                                    class="d-flex justify-content-start align-items-center nav-item-li  nav-link text-navbar {{ Route::currentRouteName() == 'admin.logout' ? 'ms_backC_secondary_selected ' : '' }}">
                                    <a class="text-navbar" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <img class="icon me-3" src="{{ asset('Icons/exit.svg') }}" alt="">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET"
                                        class="d-none">
                                        @csrf
                                        @method('GET')
                                    </form>

                                </li>
                            </ul>
                        </div>

                    </nav>
                </div>
                <div class="col-xs-12 col-md-12 col-lg-9">
                    <main class="overflow-auto vh-100">
                        @yield('content')
                    </main>
                </div>
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

    <script></script>
</body>

</html>
