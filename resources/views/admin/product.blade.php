@extends('admin.base')
@section('javascript')
    <script>
        $(function() {
            $('.change-price').click(function () {
                const sizeId = $(this).data('size_id');
                const productId = $(this).data('product_id');
                $(`input[name="products[${ sizeId }][size_id]"]`).val(sizeId);
                $(`input[name="products[${ sizeId }][product_id]"]`).val(productId);
                $(`input[name="products[${ sizeId }][flag]"]`).val(1);
            });
        });
    </script>
@endsection
@section('content')
    <form action="{{ route('admin.menu_edit', ['id' => $menu->id]) }}">
        <input type="submit" value="戻る">
    </form>

    <div class="menu">
        <p>メニュー： {{ $menu->name }}</p>
    </div>

    <table border="1">
        <tr>
            <th>サイズ</th><th>価格（税込）</th>
        </tr>
        @foreach ($rows as $row)
            <form name="products" action="{{ route('admin.menu_store_product', ['id'=>$menu->id]) }}" method="post">
                {{ csrf_field() }}
                <tr>
                    <td>{{ $row->size }}</td>
                    <td><input type="text" value="{{ $row->price }}" name="products[{{ $row->size_id }}][price]"></td>
                    <td><button class="change-price" data-menu_id="{{ $menu->id }}" data-size_id="{{ $row->size_id }}" data-product_id="{{ $row->product_id }}">変更する</button></td>
                    <input type="hidden" value="{{ $row->size_id }}" name="products[{{ $row->size_id }}][size_id]">
                    <input type="hidden" value="{{ $row->product_id }}" name="products[{{ $row->size_id }}][product_id]">
                    <input type="hidden" value=0 name="products[{{ $row->size_id }}][flag]">
                </tr>
        @endforeach
    </table>

    <form action="{{ route('admin.menu_store_product_all', ['id'=>$menu->id]) }}">
        <input type="submit" value="すべて変更する">
    </form>
@endsection
