<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }} </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    
                        @guest
                        @else
                            @if (Auth::user()->typeUser == '1' )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('createProduct') }}">Create product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('createCategory') }}">Create category</a>
                                </li>
                            @endif
                        @endguest
                    
                </ul>
                <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                          
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="badge badge-danger navbar-badge" id='cart-count-item'>
                                        
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @foreach( $cart as $key => $item )
                                        @if($item->dateBuy == '1900-01-01 12:12:12' and $item->dateNotBuy == '1900-01-01 12:12:12')
                                            <a href="{{ route('productInfo', ['id' => $item->id]) }}" class="dropdown-item items-carts">
                                                <!-- Message Start -->
                                                <div class="media">
                                                <img src="{{asset('storage/product/' . $item->productPathImage)}}" style='max-height:100px' alt="User Avatar" class="img-size-50 img-circle mr-3">
                                                <div class="media-body">
                                                    <b class="dropdown-item-title">{{$item->productName}}</b>
                                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$item->productPrice}}€</p>
                                                </div>
                                                </div>
                                                <!-- Message End -->
                                            </a>
                                        @endif
                                    @endforeach
                                    <div class="dropdown-divider "></div>
                                    <a href="{{ route('toBuy') }}" class=" btn btn-block btn-primary btn-xs" style='padding:2px'>
                                        To buy
                                    </a>
                                </div>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
            </div>
        </nav>
        <main class="py-2">
            @yield('content')
        </main>
    </div>
    <script>
       
        document.getElementById("cart-count-item").innerHTML = document.querySelectorAll('.items-carts').length;

    </script>
</body>
</html>
