<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @yield('javascript')
    <style>
        .navbar {
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(160,166,179,0.3);
        }

    </style>
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light mr-0 ml-0 mb-3">
        <a class="navbar-brand" href="">Cafe-Sugekitaura</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @if (Auth::check())
                        <a class="nav-link" href="{{ route('admin.logout') }}">ログアウト</a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
</div>

@yield('content')
</body>
</html>
