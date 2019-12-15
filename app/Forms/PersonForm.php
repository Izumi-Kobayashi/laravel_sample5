<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Person;

class PersonForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',
                  ['label' => '氏名',
                   'rules' => 'required',])
            ->add('email', 'text',
                  ['label' => 'メールアドレス',
                   'rules' => 'required',])
            ->add('age', 'text',
                  ['label' => '年齢',
                   'rules' => 'required',]);
    }

    public function save()
    {
        $values = $this->getFieldValues();
        if (empty($this->model)){
            Person::create($values);
        } else{
            $this->model->update($values);
        }
    }
}
