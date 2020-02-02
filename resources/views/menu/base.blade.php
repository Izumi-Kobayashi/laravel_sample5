<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <style>
    body {
      font-size: 0.9rem;
      background-color: #f9fbfe;
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
  <div class="container">
    @yield('content')
  </div>
</body>
</html>
