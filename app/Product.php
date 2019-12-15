<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'menu_id', 'size_id', 'price',
    ];
    public function menu()
    {
        return $this->belongsTo('App\Menu');
    }

    public function size()
    {
        // productsテーブルにsize_idがあるので、belongsToでsizesテーブルの対象のレコードを取得する
        // App\Sizeかもしれない
        return $this->belongsTo('App\Size');
    }

}
