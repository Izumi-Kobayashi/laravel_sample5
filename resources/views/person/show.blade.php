@extends('layouts.base')
@section('javascript')
    <script>
        $(function () {
            $('.delete-btn').click(function () {
                if (confirm('削除してもよろしいですか？')) {
                    const $form = $(this).parents('form');
                    $form.submit();
                }
            });
        });
    </script>
@endsection
@section('content')

    <form action="{{ route('person_index') }}" >
        <input type="submit" value="一覧">
    </form>
    <form action="{{ route('person_destroy', ['id' => $person->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="delete">
        <input type="button" class="delete-btn" value="削除">
    </form>
    <form action="{{ route('person_edit', ['id' => $person->id]) }}"  >
        <table border="1">
            <tr>
                <td>氏名</td><td>{{ $person->name }}</td>
            </tr>
            <tr>
                <td>メールアドレス</td><td>{{ $person->email }}</td>
            </tr>
            <tr>
                <td>年齢</td><td>{{ $person->age }}</td>
            </tr>
        </table>
        <input type="submit" value="編集">
    </form>
@endsection
