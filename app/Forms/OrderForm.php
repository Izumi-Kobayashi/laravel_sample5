<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class OrderForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
            ->add('created_at','text',
                ['label' => '注文日',
                    'rules' => 'required',]
            );
        $this
            ->add('menu_name','text',
                ['label' => 'メニュー',
                    'rules' => 'required',]
            );
        $this
            ->add('size_name','text',
                ['label' => 'サイズ',
                    'rules' => 'required',]
            );
        $this
            ->add('order_num','text',
                ['label' => '注文数',
                    'rules' => 'required',]
            );
        $this
            ->add('order_price','text',
                ['label' => '注文金額',
                    'rules' => 'required',]
            );

    }
}
