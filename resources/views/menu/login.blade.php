<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
    .main {
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(160,166,179,0.3);
      border: 1px solid #e1e7ec;
      border-radius: 7px;
      padding: 30px 24px;
      width: 50%;
    }
  </style>
</head>
<body>

  <div class="main border mr-auto ml-auto rounded">
    <form action="{{ route('login') }}" method="post">
      {{ csrf_field() }}

      <div class="form-group input-group">
        <input type="email" name="email" placeholder="メールアドレス" class="form-control rounded-pill">
      </div>

      <div class="form-group input-group">
        <input type="password" name="password" placeholder="パスワード" class="form-control rounded-pill">
      </div>

      <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
        <div class="custom-control custom-checkbox">
          <input class="custom-control-input" type="checkbox" id="remember_me" checked="">
          <label class="custom-control-label" for="remember_me">ログイン情報を保存</label>
        </div><a class="navi-link" href="">パスワードをお忘れですか？</a>
      </div>

      @if ($errors->any())
        <div class="row justify-content-center mt-2">
          <span class="error">{{ $errors->first() }}</span>
        </div>
      @endif

      <div class="text-center text-sm-right mt-2">
        <button class="btn btn-outline-primary rounded-pill margin-bottom-none" type="submit">ログイン</button>
      </div>
    </form>
  </div>
</body>
</html>
