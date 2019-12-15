<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Café Progate</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script>
        $(function () {
            $('.size').click(function () {
                const menuIndex = $(this).data('menu_index');
                const productId = $(this).val();
                const price = $(this).data('price');
                $(`input[name="orders[${menuIndex}][product_id]"]`).val(productId);
                $(`#price_${menuIndex}`).text(price);
            })
        });
    </script>
</head>
<body>
<div class="menu-wrapper container">
    <h1 class="logo">Café Progate</h1>
    <h3>メニュー{{ $menus->count() }}品</h3>
    <form method="post" action="{{ route('menu_confirm') }}">
        {{ csrf_field() }}
        <div class="menu-items">
            @foreach ($menus as $menuIndex => $menu)
            <div class="menu-item">
                <img src="{{ asset('storage/'.$menu->images[0]->image) }}" class="menu-item-image">
                <h3 class="menu-item-name">
                    <a href="{{ route('menu_show', ['id' => $menu->id]) }}">{{ $menu->name }}</a>
                </h3>
                @if ($menu->type == "Drink")
                    <p class="menu-item-type">{{ $menu->drink_type }}</p>
                @else
                    @for ($i=0; $i< $menu->spiciness; $i++)
                        <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/chilli.png" class='icon-spiciness'>
                    @endfor
                @endif
                <p class="price">¥<span id="price_{{ $menuIndex }}">{{ $menu->price }}</span>（税込）</p>

                {{-- サイズの切り替えで、product_id, order_priceの値を変更する必要があります --}}
                @foreach($menu->productsOrderBySize as $product)
                    <input id="size_{{ $product->id }}" type="radio" name="size_{{ $product->menu->id }}" class="size" value="{{ $product->id }}" data-menu_index="{{ $menuIndex }}" data-price="{{ $product->price }}">
                    <lable for="size_{{ $product->id }}">{{ $product->size->name }}</lable>
                @endforeach

                <!--
                product_id, order_num, order_priceを一つの配列にまとめて送ります。
                例）
                [
                    ['product_id' => 1, 'order_num' => 1],
                    ['product_id' => 3, 'order_num' => 1],
                    ['product_id' => 5, 'order_num' => 1],
                    ['product_id' => 7, 'order_num' => 1],
                ]
                -->
                <input type="text" value="0" name="orders[{{ $menuIndex }}][order_num]">
                <span>個</span>
                <input type="hidden" value="{{ $menu->products[0]->id }}" name="orders[{{ $menuIndex }}][product_id]">
            </div>
            @endforeach
        </div>
        <input type="submit" value="注文する">
    </form>
    <form action="{{ route('menu_history') }}">
        <input type="submit" value="注文履歴">
    </form>
    <form action="{{ route('logout') }}">
        <input type="submit" value="ログアウト">
    </form>
</div>
</body>
</html>
