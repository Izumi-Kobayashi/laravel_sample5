<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Size;

class ProductForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('size', 'text', [
                'label' => 'サイズ',
                'rules' => 'required',
            ])
            ->add('price', 'number', [
                'label' => '価格（税込）',
                'rules' => 'required',
            ])
            ->add('size_id', 'hidden')
            ->add('menu_id', 'hidden');
    }
}
