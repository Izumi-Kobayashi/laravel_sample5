@extends('layouts.base')

@section('content')

    <form action="{{ route('person_index') }}">
        <input type="submit" value="一覧">
    </form>

    <form action="{{ route('person_store') }}" method="post">
        {{ csrf_field() }}
        <table>
            <tr>
                <td>{!! form_label($form->name) !!}</td><td>{!! form_widget($form->name) !!}</td>
            </tr>
            <tr>
                <td>{!! form_label($form->email) !!}</td><td>{!! form_widget($form->email) !!}</td>
            </tr>
            <tr>
                <td>{!! form_label($form->age) !!}</td><td>{!! form_widget($form->age) !!}</td>
            </tr>
        </table>
        <input type="submit" value="作成">
    </form>
@endsection
