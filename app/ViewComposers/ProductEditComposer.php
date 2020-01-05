<?php
namespace App\Http\ViewComposers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductEditComposer
{
    public function compose(View $view)
    {
        $menu = $view['menu'];

        $rows = \DB::table('sizes as s')
            ->leftjoin('products as p', function ($join) use ($menu) {
                $join->on('s.id', '=', 'p.size_id')
                    ->where('p.menu_id', '=' , $menu->id)
                    ->whereNull('deleted_at');
            })
            ->select('s.name as size', 'p.price as price', 's.id as size_id', 'p.id as product_id')
            ->get();

        return $view->with(compact('rows'));
    }
}
