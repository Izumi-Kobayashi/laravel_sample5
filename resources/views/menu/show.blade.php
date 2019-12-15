<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Progate</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="review-wrapper">
    <div class="review-menu-item">
        <img src="{{ asset('storage/'.$menu->images[0]->image) }}" class="menu-item-image">
        <h3 class="menu-item-name">{{ $menu->name }}</h3>

        @if ( $menu->type  == 'Drink')
            <p class="menu-item-type">{{  $menu->drink_type }}</p>
        @else
            @for ($i = 0; $i < $menu->spiciness; $i++)
                <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/chilli.png" class='icon-spiciness'>
            @endfor
        @endif
        <p class="price">¥{{ $menu->price }}</p>
    </div>

    <div class="review-list-wrapper">
        <div class="review-list">
            <div class="review-list-title">
                <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/review.png" class='icon-review'>
                <h4>レビュー一覧</h4>
            </div>
            @foreach ($menu->reviews as $review)
                <div class="review-list-item">
                    <div class="review-user">
                        @if ( $review->user->gender == 'male')
                            <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/male.png" class='icon-user'>
                        @else
                            <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/female.png" class='icon-user'>
                        @endif
                        <p>{{ $review->user->name }}</p>
                    </div>
                    <p class="review-text">{{ $review->text }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <a href="{{ route('menu_post', ['id' => $menu->id]) }}">レビュー新規投稿　→</a>
    <p><a href="{{ route('menu_index') }}">← メニュー一覧へ</a></p>
</div>
</body>
</html>
