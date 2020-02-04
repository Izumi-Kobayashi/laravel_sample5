<?php
namespace App\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Menu;

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
        if(empty($menus)){
            $menus = Menu::all()->pluck('id')->all();
        }

        if(empty($this->request['sumFrom'])){
            $dateFrom = "2000/01/01 00:00:00";
        }else{
            $dateFrom = $this->request['sumFrom']." 00:00:00";
        }

        if(empty($this->request['sumTo'])){
            $dateTo = "2100/01/01 23:59:59";
        }else{
            $dateTo = $this->request['sumTo']." 23:59:59";
        }

        $dates[0] = $this->request['sumFrom'];
        $dates[1] = $this->request['sumTo'];
        $rows = \DB::table('orders as o')
                ->join('products as p', 'p.id', '=', 'o.product_id')
                ->join('sizes as s', 's.id', '=', 'p.size_id')
                ->join('menus as m', 'm.id', '=', 'p.menu_id')
                ->whereIn('m.id', $menus)
                ->whereBetween('o.created_at', [$dateFrom, $dateTo])
                ->select('m.name as name', 's.name as size',\DB::raw('sum(o.order_num) as num'), \DB::raw('sum(o.order_price) as price'))
                ->groupBy('m.name', 's.name')
                ->get();

        return $view->with(compact('rows', 'menus', 'dates'));
    }
}
