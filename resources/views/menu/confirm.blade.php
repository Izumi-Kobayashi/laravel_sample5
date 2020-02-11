@extends('menu.base')
@section('javascript')
    <script>
        $(function() {
            /*注文ボタン押下時、ゼロ円だったらエラーにする*/
            $('.order').click(function (){
                const $form = $('#order');
                $form.submit();
            });
        });
     </script>
@endsection
@section('css')
    <style>
        .main {
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(160,166,179,0.3);
            border: 1px solid #e1e7ec;
            border-radius: 7px;
            padding: 30px 24px;
            width: 50%;
        }

        .order {
            width: 60%;
        }
    </style>
@endsection

@section('content')
    <div class="main border mr-auto ml-auto rounded mb-5">
        <div class="d-flex justify-content-center">
            <h3>注文内容確認</h3>
        </div>

        <form method="post" action="{{ route('menu_order') }}">
            @csrf
            <div class="order mr-auto ml-auto">
                <table class="table table-borderless">
                @foreach ($orders as $orderIndex => [$product, $order_num, $totalPrice])
                    <tr>
                        <td><p class="order-amount">{{ $product->menu->name }} x {{ $order_num }} 個 </p></td>
                        <td><p class="order-price">{{ $totalPrice }}円</p></td>
                        <input type="hidden" name="orders[{{ $orderIndex }}][product_id]" value="{{ $product->id }}">
                        <input type="hidden" name="orders[{{ $orderIndex }}][order_price]" value="{{ $totalPrice }}">
                        <input type="hidden" name="orders[{{ $orderIndex }}][order_num]" value="{{ $order_num }}">
                    </tr>
                @endforeach
                </table>
            </div>
            <h3>合計金額: {{ $totalPayment }}円</h3>
            <div id="order" class="d-flex justify-content-center">
                <button class="btn btn-primary rounded-pill">注文する</button>
            </div>
        </form>
    </div>
    <form action="{{ route('menu_index') }}">
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary rounded-pill">一覧に戻る</button>
        </div>
    </form>
@endsection
