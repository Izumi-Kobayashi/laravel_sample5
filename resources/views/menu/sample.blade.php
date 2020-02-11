@extends('menus.base')

@section('css')
  <style>
    .menu-items {
      width: 80%;
      margin-right: auto;
      margin-left: auto;
    }

    .menu-item {
      text-align: center;
    }

    .menu-item-image {
      width: 400px;
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

    .amount {
      text-align: center;
      width: 15%;
    }
  </style>
@endsection

@section('content')
  <div class="d-flex justify-content-center mb-5">
    <h5>メニュー{{ $menus->count() }}品</h5>
  </div>

  <div class="menu-items">
    <div class="d-flex flex-wrap justify-content-between">
      @foreach ($menus as $menuIndex => $menu)
        <div class="menu-item mb-5">
          <img class="menu-item-image rounded" src="{{ asset('storage/images/'.$menu->image) }}">

          <h3>
            <a href="{{ route('menus.show', ['menu' => $menu->id]) }}">{{ $menu->name }}</a>
          </h3>

          <div class="menu-type">
            @if ($menu->hasType())
              <p>{{ $menu->type }}</p>
            @else
              @for ($i = 0; $i < $menu->spiciness; $i += 1)
                <img src="https://s3-ap-northeast-1.amazonaws.com/progate/shared/images/lesson/php/chilli.png" class='icon-spiciness'>
              @endfor
            @endif
          </div>

          <p class="price">¥{{ $menu->getTaxIncludedPrice() }}（税込）</p>

          <input type="hidden" name="menus[{{ $menuIndex }}][id]" value="{{ $menu->id }}">
          <input class="amount" type="text" name="menus[{{ $menuIndex }}][count]" value="0"><span class="ml-1">個</span>
        </div>
      @endforeach
    </div>
  </div>

  <div class="d-flex justify-content-center">
    <button class="btn btn-primary rounded-pill">注文する</button>
  </div>
@endsection
