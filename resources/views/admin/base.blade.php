<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/simple-sidebar.css') }}">


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

    .main {
        margin: 20px 0 20px 0;
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
<!-- Sidebar -->
<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading"><a class="unishop-logo" href="{{ route('admin.menu_index') }}">Cafe-Sugekitaura</a></div>
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.menu_index') }}" class="list-group-item list-group-item-action bg-light">メニュー一覧</a>
    </div>
</div>
<!-- /#sidebar-wrapper -->

<div class="container-fluid">
    <div class="main">
        @yield('content')
    </div>
</div>
</body>
</html>
