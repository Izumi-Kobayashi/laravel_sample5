<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Menu;
use App\Image;
use App\Size;
use App\Product;

class ImageForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('image', 'file', [
                'wrapper' => ['class' => 'form-group col'],
                'label' => false,
                'rules' => empty($this->model) ? 'required' : null,
            ])
            ->add('id', 'hidden');

    }
}
class MenuForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
            ->add('type', 'choice', [
                'label' => 'タイプ',
                'label_attr' => ['class' => 'form-inline font-weight-bold'],
                'choices' => ['Drink' => '飲み物', 'Food' => '食べ物'],
                'expanded' => true,
                'multiple' => false,
                'choice_options' => [
                    'wrapper' => ['class' => 'form-check form-check-inline'],
                    'attr' => ['class' => 'form-check-input'],
                    'label_attr' => ['class' => 'form-check-label'],
                ],
            ])
            ->add('name', 'text',[
                'label' => 'メニュー名',
                'label_attr' => ['class' => 'form-inline font-weight-bold'],
                'rules' => 'required',
                ])
            ->add('price', 'number', [
                'label' => '価格（税込）',
                'label_attr' => ['class' => 'form-inline font-weight-bold'],
/*                'rules' => 'required', */
            ])
            ->add('images','collection', [
                'type' => 'form',
                'label' => 'イメージ',
                'label_attr' => ['class' => 'form-inline font-weight-bold'],
                'prototype' => true,
                'prototype_name' => '__NAME__',
                'prefer_input' => true,
                'options' => [
                    'class' => 'App\Forms\ImageForm',
                    'wrapper' => ['class' => 'form-row image-row'],
                    'label' => false,
                    ]
                ])
            ->add('drink_type', 'choice', [
                'label' => 'ドリンクタイプ',
                'label_attr' => ['class' => 'form-inline font-weight-bold'],
                'expanded' => true,
                'multiple' => false,
                'choices' => ['アイス' => 'アイス', 'ホット' => 'ホット'],
                'choice_options' => [
                    'wrapper' => ['class' => 'form-check form-check-inline'],
                    'attr' => ['class' => 'form-check-input'],
                    'label_attr' => ['class' => 'form-check-label'],
                ],
                ])
            ->add('spiciness', 'choice', [
                'expanded' => true,
                'multiple' => false,
                'choices' => [1=>1, 2=>2, 3=>3, 4=>4, 5=>5],
                'label' => 'スパイス（辛さ）',
                'label_attr' => ['class' => 'form-inline font-weight-bold'],
                'choice_options' => [
                    'wrapper' => ['class' => 'form-check form-check-inline'],
                    'attr' => ['class' => 'form-check-input'],
                    'label_attr' => ['class' => 'form-check-label'],
                    ]
                ]);
        $this->addSize();
    }

    public function addSize()
    {
        // mapWithKeys: https://readouble.com/laravel/6.0/ja/collections.html#method-mapwithkeys
        $sizeChoices = Size::all()->mapWithKeys(function ($size) {
            return [$size->id => $size->name];
        })->all();

        if (empty($this->model)) {
            $selected = null;
        } else {
            // pluck: https://readouble.com/laravel/6.0/ja/collections.html#method-pluck
            $selected = $this->model->products->pluck('size_id')->all();
        }
        $this
            ->add('sizes', 'choice', [
                'wrapper' => ['class' => 'form-group col'],
                'label' => 'サイズ',
                'label_attr' => ['class' => 'form-inline font-weight-bold'],
                'expanded' => true,
                'multiple' => true,
                'choices' => $sizeChoices,
                'selected' => $selected,
                'choice_options' => [
                    'wrapper' => ['class' => 'form-check form-check-inline'],
                    'attr' => ['class' => 'form-check-input'],
                    'label_attr' => ['class' => 'form-check-label'],
                ],
            ]);
    }

    public function save()
    {
        $values = $this->getFieldValues();
        if (empty($this->model)){
            // メニューテーブルを保存
            $menu = Menu::create($values);

            // Menu::createの際に、$valuesに画像が含まれているためエラーとなっています。
            // 画像自体はstorageディレクトリに保存し、画像名をDBに保存する必要があります
            // storage/app/publicに画像を保存
            foreach ($values['images'] as $image) {
                $imagePath = $image['image']->store('public');
                Image::create([
                        'menu_id' => $menu->id,
                        'image' => basename($imagePath),]
                );
            }
/*
            $sizeIds = $values['sizes'];

            foreach ($sizeIds as $sizeId) {
                Product::create([
                    'menu_id' => $menu->id,
                    'size_id' => $sizeId,
                ]);
            }
*/
            return $menu;
        } else{
            // 更新済み画像ID一覧
            $updatedImageIds = [];

            $this->model->update($values);

            // イメージテーブルの更新
            foreach($values['images'] as $image){
                if (empty($image['id'])) {
                    $imagePath = $image['image']->store('public');

                    Image::create([
                        'menu_id' => $this->model->id,
                        'image' => basename($imagePath),
                    ]);
                } else {
                    $imageObj = Image::find($image['id']);

                    if ($image['image']) {
                        \Storage::delete('public/'.$image->image);

                        $imagePath = $image['image']->store('public');

                        $imageObj->update(['image' => basename($imagePath)]);
                    }

                    $updatedImageIds[] = $imageObj->id;

                }
            }
            // 更新前の画像ID一覧
            $oldImageIds = $this->model->images->pluck('id');

            // 削除対象の画像ID一覧
            // diff https://readouble.com/laravel/5.5/ja/collections.html#method-diff
            $deleteImageIds = $oldImageIds->diff($updatedImageIds);

            // deleted_atカラムに現在時間を代入
            Image::destroy($deleteImageIds);

/*
            // 更新前のサイズID一覧
            $oldSizeIds = $this->model->products->pluck('size_id');

            // 新規サイズID一覧
            $newSizeIds = collect($values['sizes'])->diff($oldSizeIds);

            // productテーブルに、新規サイズID一覧を保存
            foreach ($newSizeIds as $newSizeId) {
                Product::create([
                    'menu_id' => $this->model->id,
                    'size_id' => $newSizeId,
                ]);
            }

            // 削除対象サイズID一覧
            $deleteSizeIds = $oldSizeIds->diff($values['sizes']);

            // 削除対象サイズIDを含むプロダクトのdeleted_atカラムに現在時間を代入
            Product::whereIn('size_id', $deleteSizeIds)->delete();
*/
        }
    }
}
