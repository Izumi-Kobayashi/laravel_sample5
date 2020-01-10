<?php
@extends('layout.base')
@section('content')
    <form action="{{ route('admin.menu_index') }}">
        <input type="submit" value="戻る">
    </form>

    <table border="1">
        <tr>
            <th>メニュー名</th><th>サイズ</th><th>売上数</th><th>売上金額</th><th>注文日</th>
        </tr>
        @foreach($rows as $row)
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->size }}</td>
                <td>{{ $row->num }}</td>
                <td>{{ $row->price }}</td>
            </tr>
        @endforeach
    </table>
    {{ $menus->links() }}

@endsection
