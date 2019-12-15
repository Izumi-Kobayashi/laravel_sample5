@extends('layouts.base')

@section('content')

    <ul>
        @foreach($questions as $question)
            <li><a href="{{ route('question_show', ['id' => $question->id]) }}">{{ $question->question_text }}</a></li>
        @endforeach
    </ul>
@endsection

