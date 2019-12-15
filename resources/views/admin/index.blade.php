@extends('layouts.base')

@section('content')
    <form action="{{ route('admin.menu_create') }}">
        <input type="submit" value="新規作成">
    </form>

    <table border="1">
        <tr>
            <th>メニューNo</th><th>メニュータイプ</th><th>メニュー名</th><th>価格（税込）</th><th>イメージ</th><th>ドリンクタイプ</th><th>スパイス指数</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td><a href="{{ route('admin.menu_edit', ['id' => $menu->id]) }}">{{ $menu->id }}</a></td>
                <td>{{ $menu->type }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->price }}</td>
                <td>
                    @foreach($menu->images as $image)
                        <img width="100" alt="{{ $menu->name }}" src="{{ asset('storage/'.$image->image) }}">
                    @endforeach
                </td>
                <td>{{ $menu->drink_type }}</td>
                <td>{{ $menu->spiciness }}</td>
            </tr>
        @endforeach
    </table>
    <form action="{{ route('admin.logout') }}">
        <input type="submit" value="ログアウト">
    </form>

@endsection
