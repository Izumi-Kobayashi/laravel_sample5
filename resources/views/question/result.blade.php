@extends('layouts.base')

@section('content')

    <h4>$question->question_text</h4>

    <ul>
        @foreach($questions->choices as $choice)
            <li>{{ $choice->choice_text }} -- {{ $choice->vote }}</li>
        @endforeach
    </ul>

    <a href="{{ route('question_show', ['id' => $question->id]) }}">Vote again?</a>
@endsection

