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
        foreach ($this->request['sizes'] as $size) {
            if (empty($size['price'])) {
                Product::where([
                    'menu_id' => $menu->id,
                    'size_id' => $size['size_id']
                ])->delete();
/*            } elseif (empty($size['product_id'])) {
                Product::create([
                    'menu_id' => $menu->id,
                    'size_id' => $size['size_id'],
                    'price' => $size['price'],
                ]);
            } else {
                Product::where('id', $size['product_id'])
                       ->update(['price' => $size['price']]);
 */           } else {
                Product::updateOrCreate(
                    ['menu_id' => $menu->id, 'size_id' => $size['size_id']],
                    ['price' => $size['price']]
                );
            }
        }
    }
}
