@extends('layouts.base')

@section('content')

    <form action="{{ route('person_create') }}">
        <input type="submit" value="新規作成">
    </form>

    <table border="1">
        <tr>
            <th>氏名</th><th>メールアドレス</th><th>年齢</th>
        </tr>
        @foreach($people as $person)
            <tr>
                <td><a href="{{ route('person_show', ['id' => $person->id]) }}">{{ $person->name }}</a></td>
                <td>{{ $person->email }}</td>
                <td>{{ $person->age }}</td>
            </tr>
        @endforeach
    </table>
@endsection
