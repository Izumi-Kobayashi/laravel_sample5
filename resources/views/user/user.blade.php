@extends('user.base')
@section('javascript')
    <script>
        $(function() {
            /*注文ボタン押下時、ゼロ円だったらエラーにする*/
            $('.create').click(function (){
                const $form = $('#create');
                $form.submit();
            });
        });
    </script>
@endsection
@section('css')
    <style>
        .container {
            width: 40%;
        }

        input {
            margin-left: initial;
            margin-right: initial;
            padding: initial;
            text-align: initial;
            width: initial;
            font-size: initial;
            margin-top: initial;
        }
        select {
            -webkit-appearance: none;
            -webkit-border-radius: 0px;
        }
        .error {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="menu-wrapper container">

    <form id="create" method="post" action="{{ route('user_create') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <span class="error">{{ $errors->first('name') }}</span>
            <input type="text" class="form-control rounded-pill" name="name" placeholder="名前" required>
        </div>
        <div class="form-group">
            <span class="error">{{ $errors->first('email') }}</span>
            <input type="email" class="form-control rounded-pill" name="email" placeholder="メールアドレス" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control rounded-pill" name="password" placeholder="パスワード" required>
        </div>
        <div class="form-group">
            @foreach (['male' => '男性', 'female' => '女性'] as $value => $show)
                <div class="form-check form-check-inline">
                    <input class="form-check-input menu-type" type="radio" id="{{ $value }}" name="gender" value="{{ $value }}" required>
                    <label class="form-check-label" for="{{ $value }}">{{ $show }}</label>
                </div>
            @endforeach
        </div>
        <input type="submit" value="登録する" style="text-align: center">
    </form>
    </div>
@endsection


