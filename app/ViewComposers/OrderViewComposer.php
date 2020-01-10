<?php
namespace App\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderViewComposer
{
    public function compose(Request $request, View $view)
    {

        $rows = \DB::table('orders as o')
                ->join('products as p', 'p.id', '=', 'o.product_id')
                ->join('sizes as s', 's.id', '=', 'p.size_id')
                ->join('menus as m', 'm.id', '=', 'p.menu_id')
                ->wherein('m.id', $request['select'])
                ->select('m.name as name', 's.name as size','sum(o.order_num) as num', 'sum(o.order_price) as price')
                ->get();

        return $view->with(compact('rows'));
    }
}
