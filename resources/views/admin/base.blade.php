<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <style>
    body {
      font-size: 0.9rem;
/*      background-color: #f9fbfe; */
        background-color: white;
    }

    .container-fluid {
        padding: 0 !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }
    .navbar {
        background-color: #fff;
        box-shadow: 0 1px 3px rgba(160,166,179,0.3);
    }

    .error {
      color: red
    }

    .warning {
      color: red;
    }
  </style>
  @yield('javascript')
  @yield('css')
</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light mr-0 ml-0 mb-3">
        <a class="navbar-brand" href="">Samurai</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">アカウント作成</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">ログイン</a>
                </li>
            </ul>
        </div>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>
