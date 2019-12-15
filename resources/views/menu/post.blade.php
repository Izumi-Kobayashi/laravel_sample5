@extends('menu.base')

@section('content')
    <a href="{{ route('menu_show', ['id' => $menu->id]) }}">← レビュー一覧へ</a>
    <form action="{{ route('menu_store', ['menu' => $menu]) }}" method="post">
        {{ csrf_field() }}
        <p>メニュー{{ $menu->name }}</p>
        <img src="{{$menu->image}}">
        <p>{!! form_label($form->text) !!}{!! form_widget($form->text) !!}</p>
        <input type="submit" value="投稿する">
    </form>
@endsection

