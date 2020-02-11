@extends('menu.base')

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
        <div class="d-flex justify-content-center mb-5">
            <div class="menu bg-white">
                <img src="{{ asset('storage/'.$menu->images[0]->image) }}" class="menu-item-image">

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

        <div class="comment bg-white mb-2">
            <div class="d-flex justify-content-between">
                <span class="font-weight-bold">レビュー</span>
                <a href="{{ route('menu_post', ['id' => $menu->id]) }}">レビューを書く</a>
            </div>
        </div>

        @if ($reviews->count() > 0)
            <div class="comment bg-white mb-2">
                <table class="table">
                    @foreach ($reviews as $reviewIndex => $review)
                        <tr>
                            <td @if ($reviewIndex === 0) class="td" @endif>
                                {{ $review->created_at }} {{ $review->user->name }}<br>
                                {{ $review->text }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif

        @if ($reviews->lastPage() > 1)
            <div class="d-flex justify-content-center mb-4">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item @if ($reviews->currentPage() === 1) disabled @endif">
                            <a class="page-link" href="{{ route('menu_index', ['page' => $reviews->currentPage() - 1]) }}" tabindex="-1">Previous</a>
                        </li>
                        @for ($page = 1; $page <= $reviews->lastPage(); $page += 1)
                            @if ($page === $reviews->currentPage())
                                <li class="page-item active">
                                    <a class="page-link" href="{{ route('menu_index', ['page' => $page]) }}">{{ $page }} <span class="sr-only">(current)</span></a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ route('menu_index', ['page' => $page]) }}">{{ $page }}</a></li>
                            @endif
                        @endfor
                        <li class="page-item @if ($reviews->currentPage() === $reviews->lastPage()) disabled @endif">
                            <a class="page-link" href="{{ route('menu_index', ['page' => $reviews->currentPage() + 1]) }}">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif

        <form action="{{ route('menu_index') }}">
            <div class="d-flex justify-content-center">
                <button class="btn btn-secondary rounded-pill">戻る</button>
            </div>
        </form>
    </div>
@endsection
