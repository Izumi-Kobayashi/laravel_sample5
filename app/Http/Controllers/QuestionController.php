<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index()
    {
        $questions = Question::all();

        return view('question.index', compact('questions'));
    }

    public function show($id)
    {
        $question = Question::find($id);

        return view('question.show', compact('question'));
    }

    public function vote(Request $request, $id)
    {
        $question = Question::find($id);

        $choice = $question->choices->find($request['choice']);

        $choice->vote += 1;

        $choice->update();

        return redirect(route('question_result', ['id' => $id]));
    }

    public function result($id)
    {
        $question = Question::find($id);

        return view('question.result', compact('question'));
    }
}
