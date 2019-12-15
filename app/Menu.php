<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'type', 'name','price','drink_type','spiciness'
    ];

    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function productsOrderBySize()
    {
        return $this->products()->orderBy('size_id');
    }
    public function productsWithSize()
    {
        $products = [];
        foreach ($this->products as $product) {
            // size_idをkey, productインスタンスをvalueとする
            $products[$product->size->id] = $product;
        }
        $productsWithSize = [];
        foreach (Size::all() as $size) {
            // size_idが$productsにある場合、[$product, $size]の配列とし、
            // ない場合、[null, $size]の配列とする
            if (isset($products[$size->id])) {
                $productsWithSize[] = [$products[$size->id], $size];
            } else {
                $productsWithSize[] = [null, $size];
            }
        }
        return $productsWithSize;
    }

    public function sizes()
    {
        // 自分のIDを含むProductのうち、size_idカラムの値だけを取得する
        $this->products->pluck('size_id')->all();
    }

}
