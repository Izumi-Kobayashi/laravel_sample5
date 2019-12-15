<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Review;

class ReviewForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
            ->add('text','text',
                ['label' => 'レビュー内容',
                 'rules' => 'required',]
        );
    }

    public function save()
    {
        $values = $this->getFieldValues();

        // Controllerで渡したmenuのidを取得
        $values['menu_id'] = $this->data['menu']->id;

        // ログインしているユーザーIDを取得
        $values['user_id'] = $this->request->user()->id;

        Review::create($values);
    }
}
