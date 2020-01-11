@extends('layouts.base')
@section('javascript')
    <script>
        $(function() {
            $('.total-sales').click(function () {
                //すべてのチェック済みvalue値を取得する
                $('input:checked').each(function () {
                    const menu_id = $(this).val();
                    $('input[name="menu_ids"]').val(menu_id);
                })
                const $form = $('#total-sales-form');
                $form.submit();
            })
        })
    </script>
@endsection
@section('content')
    <form action="{{ route('admin.menu_create') }}">
        <input type="submit" value="新規作成">
    </form>

    <table border="1">
        <tr>
            <th></th><th>メニューNo</th><th>メニュータイプ</th><th>メニュー名</th><th>イメージ</th><th>ドリンクタイプ</th><th>スパイス指数</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td><input type="checkbox" name="select_sale" value = {{$menu->id}} ></td>
                <td><a href="{{ route('admin.menu_edit', ['id' => $menu->id]) }}">{{ $menu->id }}</a></td>
                <td>{{ $menu->type }}</td>
                <td>{{ $menu->name }}</td>
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
    {{ $menus->links() }}
    <form id="total-sales-form" action="{{ route('admin.total_sale') }}">
        <button type="button" class="btn btn-outline-primary total-sales" >選択して売上集計</button>
    </form>
    <form action="{{ route('admin.logout') }}">
        <input type="submit" value="ログアウト">
    </form>

@endsection
