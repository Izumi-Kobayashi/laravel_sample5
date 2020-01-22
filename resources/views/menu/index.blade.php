<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Café Progate</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/iziToast.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iziToast.min.css') }}">
    <style>
        ul, ol {
            list-style-type: none;
            padding-left: 0px;
            padding-right: 0px;
        }
    </style>
    <script>
        $(function () {
            @if (Auth::check())
            // お気に入りに追加しているmenuId一覧を取得
            $.ajax({
                url: '/favorite-menus'
            }).done(function (response) {
                const favoriteMenuIds = response['favoriteMenuIds'];
                // 商品を一つ一つ見ていき、お気に入りmenuIdに含まれていればハートマークにチェックを入れる
                $('.good').each(function () {
                    const menuId = String($(this).data('menu_id'));
                    if (favoriteMenuIds.includes(menuId)) {
                        $(this).css('background-image', 'url(//im.uniqlo.com/images/jp/pc/img/feature/wishlist/wishlist_heart_small_on.png)');
                    }
                });
            });
            @else
            let favoriteMenuIds = [];

            const favoritesString = localStorage.getItem('favorites');

            if (favoritesString) {
                favoriteMenuIds = JSON.parse(favoritesString);
            }

            $('.good').each(function () {
                const menuId = $(this).data('menu_id');
                if (favoriteMenuIds.includes(menuId)) {
                    $(this).css('background-image', 'url(//im.uniqlo.com/images/jp/pc/img/feature/wishlist/wishlist_heart_small_on.png)');
                }
            });
            @endif

            $('.size').click(function () {
                const menuIndex = $(this).data('menu_index');
                const productId = $(this).val();
                const price = $(this).data('price');
                $(`input[name="orders[${menuIndex}][product_id]"]`).val(productId);
                $(`#price_${menuIndex}`).text(price);
            })
            $('.good').click(function () {
                addRemoveFavorite($(this));
                return false;
            });
        });
        function showIziToast(message, messageColor, backgroundColor, iziToast1 = iziToast) {
            toastOptions = {
                animateInside: false,
                position: 'topRight',
                progressBar: false,
                timeout: 3200,
                transitionIn: 'fadeInLeft',
                transitionOut: 'fadeOut',
                transitionInMobile: 'fadeIn',
                transitionOutMobile: 'fadeOut',
            };
            toastOptions.class = 'iziToast-info';
            toastOptions.message = message;

            toastOptions.messageColor = messageColor;
            toastOptions.backgroundColor = backgroundColor;
            toastOptions.class = 'myToastClass';
            iziToast1.show(toastOptions);
        }

        function addRemoveFavorite(obj) {
            const menuId = obj.data('menu_id');

            // ログインしている場合
            @if (Auth::check())
               $.ajax({
                    url: `/favorite-menus/${menuId}`,
                    method: 'post',
                    data: { _token: '{{ csrf_token() }}' },
               }).done(function (response) {
                    const action = response['action'];

                    afterAddRemoveFavorite(obj, action)
                });
            @else
                const favoriteMenuIdsString = localStorage.getMenu('favorites');

                let favoriteMenuIds, action;

                if (favoriteMenuIdsString) {
                    favoriteMenuIds = JSON.parse(favoriteMenuIdsString);

                    const menuIdIndex = favoriteMenuIds.indexOf(menuId);

                    if (menuIdIndex === -1) {
                        favoriteMenuIds.push(menuId);
                        action = 'add';
                    } else {
                        favoriteMenuIds.splice(menuIdIndex, 1);
                        action = 'remove';
                    }
                } else {
                    action = 'add';
                    favoriteMenuIds = [menuId];
                }

                localStorage.setItem('favorites', JSON.stringify(favoriteMenuIds));

                afterAddRemoveFavorite(obj, action);
            @endif
        }

        function afterAddRemoveFavorite(obj, action) {
            let message, messageColor, backgroundColor;

            if (action === 'add') {
                message = 'お気に入りに追加しました！';
                messageColor = '#39bfe6';
                backgroundColor = '#e6f7fc';
                const url = 'url(//im.uniqlo.com/images/jp/pc/img/feature/wishlist/wishlist_heart_small_on.png)';
                obj.css('background-image', url);
            } else {
                message = 'お気に入りから削除しました！';
                messageColor = '#ff5252';
                backgroundColor = '#ffebeb';
                const url = 'url(//im.uniqlo.com/images/jp/pc/img/feature/wishlist/wishlist_heart_small_off.png)';
                obj.css('background-image', url);
            }

            showIziToast(message, messageColor, backgroundColor);
        }

    </script>
</head>
<body>
<div class="top-image-area">
    <nav>
        <ul>
            <li><a href="{{ route('menu_history') }}" class="btn1">注文履歴</a></li>
            <li><a href="{{ route('favorite_show') }}" class="btn2">お気に入り</a></li>
            <li><a href="{{ route('logout') }}" class="btn3">ログアウト</a></li>
        </ul>
    </nav>
</div>

<div class="menu-wrapper container">
    <h1 class="logo">Café Progate</h1>
    <h3>メニュー{{ $menus->count() }}品</h3>
    <form method="post" action="{{ route('menu_confirm') }}">
        {{ csrf_field() }}
        <div class="menu-items">
            @foreach ($menus as $menuIndex => $menu)
            <div class="menu-item">
                <div class="good-box">
                    <img src="{{ asset('storage/'.$menu->images[0]->image) }}" class="menu-item-image">
                    <div class="good" data-menu_id="{{ $menu->id }}">
                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    </div>
                </div>
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
                <p><input type="text" value="0" name="orders[{{ $menuIndex }}][order_num]"></p>
                <span>個</span>
                <input type="hidden" value="{{ $menu->products[0]->id }}" name="orders[{{ $menuIndex }}][product_id]">
            </div>
            @endforeach
        </div>
        <input type="submit" value="注文する">
</div>
</body>
</html>
