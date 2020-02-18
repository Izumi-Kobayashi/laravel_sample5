<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
{{--
  <script src="{{ asset('js/jquery.easyui.min.js') }}"></script>
--}}
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/simple-sidebar.css') }}">
  <style>
    .cafe-logo {
      color: rgba(0,0,0,.9);
    }

    .cafe-logo:hover {
      color: rgba(0,0,0,.9);
      text-decoration:none;
    }

    .main {
      margin: 20px 0 20px 0;
    }
  </style>
  @yield('javascript')
  @yield('css')
</head>
<body>
<div class="d-flex" id="wrapper">
    @php
    $now = new Datetime('now');
    @endphp
  <!-- Sidebar -->
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading"><a class="cafe-logo" href="{{ route('admin.calendar',  ['month' => $now->format('Y-m')]) }}">Cafe-Sugekitaura</a></div>
    <div class="list-group list-group-flush">
      <a href="{{ route('admin.menu_index') }}" class="list-group-item list-group-item-action bg-light">メニュー一覧</a>
      <a href="{{ route('admin.menu_create') }}" class="list-group-item list-group-item-action bg-light">メニュー作成</a>
    </div>
  </div>
  <!-- /#sidebar-wrapper -->

  <!-- Page Content -->
  <div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.logout') }}">ログアウト<span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="main">
        @yield('content')
      </div>
    </div>
  </div>
</div>
</body>
</html>

