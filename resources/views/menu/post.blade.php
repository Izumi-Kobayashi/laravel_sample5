@extends('menu.base')

@section('javascript')
    <script>
        $(function () {
            $('.back').click(function () {
                const $form = $(this).parents('form');
                const $action = $(this).data('action');
                $form.attr('action', $action);
                $form.attr('method', 'GET');
                $form.submit();
            });
        });
    </script>
@endsection

@section('css')
    <style>
        .main {
            width: 400px;
            margin-right: auto;
            margin-left: auto;
        }

        .menu {
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(160,166,179,0.3);
        }

        .menu-item-image {
            border-radius: 5px 5px 0 0;
        }

        .menu-type {
            height: 20px;
        }

        .icon-spiciness {
            width: 20px;
        }

        .price {
            margin: 15px 0;
            font-size: 18px;
        }

        .comment {
            box-shadow: 0 1px 3px rgba(160,166,179,0.3);
            padding: .75rem 1rem;
        }

        table .td {
            border-top: none;
        }
    </style>
@endsection

@section('content')
    <div class="main">
        <form action="{{ route('menu_store', ['menu' => $menu]) }}" method="post">
            @csrf

            <div class="d-flex justify-content-center mb-5">
                <div class="menu bg-white">
                    <img src="{{ asset('storage/'.$menu->images[0]->image) }}" class="menu-item-image" width="400px">

                    <h4 class="mt-4">{{ $menu->name }}</h4>

                    <div class="menu-type">
                        @if ($menu->type  == 'Drink')
                            <p>{{ $menu->type }}</p>
                        @else
                            @for ($i = 0; $i < $menu->spiciness; $i += 1)
                                <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/chilli.png" class='icon-spiciness'>
                            @endfor
                        @endif
                    </div>

                    <p class="price">¥{{ $menu->products[0]->price }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-center mb-2">
                <textarea name="text" class="form-control" placeholder="レビュー" required></textarea>
            </div>

            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-secondary rounded-pill mr-1 back" data-action="{{ route('menu_show', ['id' => $menu->id]) }}">戻る</button>
                <button class="btn btn-primary rounded-pill ml-1">投稿する</button>
            </div>
        </form>
    </div>
@endsection
