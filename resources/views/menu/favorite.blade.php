@extends('menu.base')
@section('content')

    <p>利用者：{{ Auth::user()->name }}</p>

    <table border="1">
        <tr bgcolor="#00ffff">
            <th>No.</th><th>メニュー</th><th>イメージ</th>
        </tr>
        @foreach (Auth::user()->favorites as $index=>$favorite)
            <tr bgcolor="#ffffff">
                <td>{{ $index +1 }}</td>
                <td>{{ $favorite->menu->name }}</td>
                <td><img src="{{ asset('storage/'.$favorite->menu->images[0]->image) }}" class="menu-item-image"></td>
            </tr>
        @endforeach
    </table>
    <form action="{{ route('menu_index') }}">
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary rounded-pill">メニューへ戻る</button>
        </div>
    </form>

@endsection
