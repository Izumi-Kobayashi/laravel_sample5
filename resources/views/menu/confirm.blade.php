<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Progate</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="order-wrapper">
    <h2>注文内容確認</h2>

    <form method="post" action="{{ route('menu_order') }}">
        @csrf
      @foreach ($orders as $orderIndex => [$product, $order_num, $totalPrice])
        <p class="order-amount">{{ $product->menu->name }} x {{ $order_num }} 個 </p>
        <p class="order-price">{{ $totalPrice }}円</p>
        <input type="hidden" name="orders[{{ $orderIndex }}][product_id]" value="{{ $product->id }}">
        <input type="hidden" name="orders[{{ $orderIndex }}][order_price]" value="{{ $totalPrice }}">
        <input type="hidden" name="orders[{{ $orderIndex }}][order_num]" value="{{ $order_num }}">
      @endforeach

      <h3>合計金額: {{ $totalPayment }}円</h3>
      <input type="submit" value="注文する">
    </form>
</div>
<form action="{{ route('menu_index') }}">
    <input type="submit" value="一覧へ戻る">
</form>
</body>
</html>
