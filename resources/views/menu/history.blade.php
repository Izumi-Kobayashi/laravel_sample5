@extends('menu.base')

@section('content')
    <form action="{{ route('menu_index') }}">
        <input type="submit" value="メニューへ戻る">
    </form>

    <p>利用者：{{ Auth::user()->name }}</p>

        <table border="1">
            <tr bgcolor="#00ffff">
                <th>注文日</th><th>メニュー</th><th>サイズ</th><th>数量</th><th>金額</th>
            </tr>
            @foreach (Auth::user()->orders as $order)
                <tr bgcolor="#ffffff">
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->product->menu->name }}</td>
                    <td>{{ $order->product->size->name }}</td>
                    <td>{{ $order->order_num }}</td>
                    <td>{{ $order->order_price }}</td>
                </tr>
            @endforeach
        </table>


@endsection
