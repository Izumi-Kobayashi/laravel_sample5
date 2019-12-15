@extends('layouts.base')

@section('content')

    <form action="{{ route('person_index') }}">
        <input type="submit" value="一覧">
    </form>

    <form action="{{ route('person_update', ['id' => $person->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
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
        <input type="submit" value="変更">
    </form>
@endsection

