@extends('layouts.base')

@section('content')

    <h4>{{ $question->question_text }}</h4>

    <form action="{{ route('question_vote',  ['id' => $question->id]) }}" method="post">
        {{ csrf_field() }}
        @foreach($question->choices as $i => $choice)
            <input type="radio" name="choice" id="choice{{ $i }}" value="{{ $choice->id }}">
            <label for="choice{{ $i }}">{{  $choice->choice_text }}</label><br>
        @endforeach
        <input type="submit" value="Vote">
    </form>
@endsection
