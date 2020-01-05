@extends('admin.base')
@section('javascript')
    <script>
        $(function() {
            $('.change-price').click(function () {
                const sizeId = $(this).data('size_id');
                const price = $(`#price-${sizeId}`).val();
                $('input[name="sizes[0][size_id]"]').val(sizeId);
                $('input[name="sizes[0][price]"]').val(price);
                const $form = $('#change-price-form');
                $form.submit();
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

    <form id="change-price-form" name="products" action="{{ route('admin.menu_store_product', ['menu'=>$menu->id]) }}" method="post">
        @csrf
        <input type="hidden" name="sizes[0][product_id]">
        <input type="hidden" name="sizes[0][size_id]">
        <input type="hidden" name="sizes[0][price]">
    </form>

    <form action="{{ route('admin.menu_store_product', ['menu' => $menu->id]) }}" method="post">
        {{ csrf_field() }}

        <table border="1">
            <tr>
                <th>サイズ</th><th>価格（税込）</th>
            </tr>
            @foreach ($rows as $index => $row)
                {{ csrf_field() }}
                <tr>
                    <td>{{ $row->size }}</td>
                    <td><input type="number" id="price-{{ $row->size_id }}" value="{{ $row->price }}" name="sizes[{{ $index }}][price]"></td>
                    <td><button type="button" class="change-price" data-menu_id="{{ $menu->id }}" data-size_id="{{ $row->size_id }}" data-product_id="{{ $row->product_id }}">変更する</button></td>
                    <input type="hidden" name="sizes[{{ $index }}][size_id]" value="{{ $row->size_id }}">
                    <input type="hidden" name="sizes[{{ $index }}][product_id]" value="{{ $row->product_id }}">
                </tr>
            @endforeach
        </table>
        <input type="submit" value="すべて変更する">
    </form>
@endsection
