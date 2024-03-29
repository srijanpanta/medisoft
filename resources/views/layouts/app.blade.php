<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ "Medisoft" }}</title>

    <!-- Scripts -->
   
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/latest/js/bootstrap.bundle.js"></script>
   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
   
    <!-- Styles -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/latest/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">

                    <img src ="{{asset('images/logo.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                            <li class="nav-item mr-lg-5 mr-2">
                                <a class="nav-link notification" href="{{ route('medichat') }}"><i class="fa-solid fa-message"></i>
                                @php
                                    $unseenMsg= DB::table('ch_messages')->where('to_id',Auth::user()->id)->where('seen','0')->get();
                                    $unseenCounter = count($unseenMsg);
                                @endphp
                                 <span class="badge">{{$unseenCounter}}</span></a>
                            </li>
                            <li class="nav-item mr-lg-5 mr-2">
                                <a class="nav-link notification" href="{{route('notifications')}}"><i class="fa-solid fa-bell"></i>
                                 @php
                                    $unseenNotification= Auth::user()->unreadNotifications->count();
                                    
                                @endphp
                                 <span class="badge">{{$unseenNotification}}</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a  class = "dropdown-item" href="{{route('reports.index')}}">Dashboard</a>
                                    <a  class = "dropdown-item" href="{{route('home')}}">Accounts</a>

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
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
        @if(session()->has('success'))
            {{-- <div class="alert alert-success alert-dismissable fade show col-4" style="position: fixed; bottom:0; right:0; height:4rem">
                <div class="row">
                    <h5 class="col-9 py-1">
                        {{ session()->get('success') }}
                    </h5>
                    <a class="close btn col-1" type="button" data-bs-dismiss="alert"><h5 class="fas fa-times-circle text-center text-danger"></h5></a>
                </div>
                
            </div> --}}
             <div class="new-message-box" id="msgBox">
                    <div class="new-message-box-success">
                        <div class="info-tab tip-icon-success  " title="error"><i></i></div>
                        <div class="tip-box-success d-flex justify-content-between">
                            <p class="mr-5">{{ session()->get('success') }}</p>
                            <div class="removeMsg mr-2" onclick="closer()">&times;</div>
                        </div>
                    </div>
           </div>     
             
        @endif

        @if(session()->has('warning'))
        <div class="new-message-box" id="msgBox">
                    <div class="new-message-box-warning">
                        <div class="info-tab tip-icon-warning" title="error"><i></i></div>
                        <div class="tip-box-warning d-flex justify-content-between">
                            <p class="mr-5">{{ session()->get('warning') }}</p>
                            <div class="removeMsg mr-2" onclick="closer()">&times;</div>
                        </div>
                    </div>
           </div>     
             
        @endif


           
    </div>
     <script>
        function closer(){
            const msgBox= document.getElementById('msgBox');
            msgBox.classList.add('fade');
        }
    </script>
    <script src = "{{ asset('js/custom.js') }}"></script>
   
</body>
</html>
