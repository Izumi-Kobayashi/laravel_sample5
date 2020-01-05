<?php

namespace App\Services;

use App\Product;
use Illuminate\Http\Request;

class ProductUpdateService
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function update()
    {
        $menu = $this->request['menu'];

        foreach ($this->request['products'] as $product) {
            if (empty($product['price'])) {
                Product::where([
                    'menu_id' => $menu->id,
                    'size_id' => $product['size_id']
                ])->delete();
            } elseif (empty($product['product_id'])) {
                Product::create([
                    'menu_id' => $menu->id,
                    'size_id' => $product['size_id'],
                    'price' => $product['price'],
                ]);
            } else {
                Product::where('id', $product['product_id'])
                       ->update(['price' => $product['price']]);
            }
        }
    }
}