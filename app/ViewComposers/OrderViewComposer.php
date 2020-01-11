<?php
namespace App\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderViewComposer
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function compose(View $view)
    {

        $menus = $this->request['menu_ids'];

        $rows = \DB::table('orders as o')
                ->join('products as p', 'p.id', '=', 'o.product_id')
                ->join('sizes as s', 's.id', '=', 'p.size_id')
                ->join('menus as m', 'm.id', '=', 'p.menu_id')
                ->whereIn('m.id', $menus)
                ->select('m.name as name', 's.name as size','sum(o.order_num) as num', 'sum(o.order_price) as price')
                ->get();

        return $view->with(compact('rows'));
    }
}
