<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Forms\PersonForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class PersonController extends Controller
{
    use FormBuilderTrait;

    public function index()
    {
        $people = Person::all();

        return view('person.index', compact('people'));
    }

    public function create()
    {
        $form = $this->form(PersonForm::class);

        return view('person.create', compact('form'));
    }

    public function store(){
        $form = $this->form(PersonForm::class);

        if (!$form->isValid($form)){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->save();

        return redirect(route('person_index'));
    }

    public function show($id)
    {
        $person = Person::find($id);

        return view('person.show', compact('person'));
    }
    public function edit($id)
    {
        $person = Person::find($id);

        $form = $this->form(PersonForm::class, ['model' => $person]);

        return view('person.edit', compact('form', 'person'));
    }

     public function update($id)
     {
        $person = Person::find($id);

         $form = $this->form(PersonForm::class, ['model' => $person]);

         if (!$form->isValid($form)){
             return redirect()->back()->withErrors($form->getErrors())->withInput();
         }

         $form->save();

         return redirect(route('person_index'));
     }

     public function destroy($id)
     {
         $person = Person::find($id);

         $person->delete();

         return redirect(route('person_index'));

     }
}


