@extends('admin.base')
@section('javascript')
    <script>
        $(function() {
            $('.total-sales').click(function () {
                //すべてのチェック済みvalue値を取得する
                const $form = $('#total-sales-form');
                var check_count = 0;
                $('input:checked').each(function (i) {
                    check_count++;
                    const menuId = $(this).val();
                    // formにhidden inputを作成する
                    $('<input>').attr({
                        type: 'hidden',
                        name: `menuIds[${i}]`,
                        value: menuId,
                    }).appendTo($form);
                });
                if (check_count == 0 ){
                    alert("メニューを選択してください。")
                    return false;
                };
                $form.submit();
            })
            /*新規作成*/
            $('.create').click(function (){
                const $form = $('#create');
                $form.submit();
            })
            /*ログアウト*/
            $('.logout').click(function (){
                const $form = $('#logout');
                $form.submit();
            })
        })
    </script>
@endsection
@section('content')

    <table border="1">
        <tr bgcolor="#f0e68c">
            <th>選択</th><th>メニューNo</th><th>メニュータイプ</th><th>メニュー名</th><th>イメージ</th><th>ドリンクタイプ</th><th>スパイス指数</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td><input class="sale-check" type="checkbox" name="select_sale" value = {{$menu->id}} ></td>
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
    <ul class="pagination justify-content-left">
        {{ $menus->links() }}
    </ul>
    <div class="inline-block-button">
        <form id="create" action="{{ route('admin.menu_create') }}">
            <button type="button" class="btn btn-outline-primary create" >メニューの新規作成</button>
        </form>
    </div>
     <div class="inline-block-button">
        <form id="total-sales-form" action="{{ route('admin.total_sale') }}">
            <button type="button" class="btn btn-outline-primary total-sales" >選択して売上集計を表示する</button>
        </form>
    </div>
    <div class="inline-block-button">
    <form id="logout" action="{{ route('admin.logout') }}">
        <button type="button" class="btn btn-outline-primary logout" >ログアウト</button>
    </form>
    </div>

@endsection
