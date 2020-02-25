<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <style>
    body {
      font-size: 0.9rem;
      background-color: #f9fbfe;
      margin-top: 20px;
      margin-bottom: 20px;
    }
  </style>
  @yield('javascript')
  @yield('css')
</head>
<body>
   @yield('content')
</body>
</html>
