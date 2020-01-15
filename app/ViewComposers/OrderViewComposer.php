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

        $menus = $this->request['menuIds'];
        $dates = $this->request['sumDates'];
        if(empty($dates)){
            $dates[0] = "2000/01/01";
            $dates[1] = "2100/01/01";
        }

        $rows = \DB::table('orders as o')
                ->join('products as p', 'p.id', '=', 'o.product_id')
                ->join('sizes as s', 's.id', '=', 'p.size_id')
                ->join('menus as m', 'm.id', '=', 'p.menu_id')
                ->whereIn('m.id', $menus)
                ->whereBetween('o.created_at', [$dates[0], $dates[1]])
                ->select('m.name as name', 's.name as size',\DB::raw('sum(o.order_num) as num'), \DB::raw('sum(o.order_price) as price'))
                ->groupBy('m.name', 's.name')
                ->get();

        return $view->with(compact('rows'));
    }
}
