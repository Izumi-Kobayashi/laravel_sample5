<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
{{--
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <style>
        body {
            font-size: 0.9rem;
            background-color: #f9fbfe;
            margin-bottom: 20px;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(160,166,179,0.3);
        }
    </style>

    @yield('javascript')
    @yield('css')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light mr-0 ml-0 mb-3">
    <a class="navbar-brand" href="">Cafe Sugekiraura</a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav">
            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('menu_history')}}">注文履歴</a>
                        <a class="dropdown-item" href="{{route('favorite_show')}}">お気に入り</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}">ログアウト</a>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="">アカウント作成</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">ログイン</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>
