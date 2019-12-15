<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Menu;
use App\Order;
use App\User;
use App\Product;
use App\Size;
use App\Forms\ReviewForm;
use App\Forms\OrderForm;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class MenuController extends Controller
{
    //
    use FormBuilderTrait;

    public function index()
    {
        $menus = Menu::all();

        return view('menu.index', compact( 'menus'));
    }

    public function show($id)
    {
        $menu = Menu::find($id);

        return view('menu.show', compact('menu'));
    }

    public function confirm(Request $request)
    {
        $totalPayment = 0;

        $orders = [];

        foreach ($request['orders'] as ['product_id' => $product_id, 'order_num' => $order_num]) {
            $product = Product::find($product_id);

            $totalPrice = $product->price * $order_num;

            $totalPayment += $totalPrice;

            $orders[] = [$product, $order_num, $totalPrice];
        }

        return view('menu.confirm', compact('totalPayment', 'orders'));
    }

    public function post($id)
    {
        $menu = Menu::find($id);
        $form = $this->form(ReviewForm::class);

        return view('menu.post', compact('menu', 'form'));
    }

    public function store(Menu $menu)
    {
        $form = $this->form(ReviewForm::class, ['data' => ['menu' => $menu]]);

        $form->save();

        return redirect(route('menu_show', ['id' => $menu->id]));
    }

    public function order(Request $request)
    {
        foreach ($request['orders'] as $order) {
            if ($order['order_num'] > 0) {
                Order::create([
                    'product_id' => $order['product_id'],
                    'user_id' => $request->user()->id,
                    'order_price' => $order['order_price'],
                    'order_num' => $order['order_num'],
                ]);
            }
        }

        return redirect(route('menu_index'));
    }

    public function history()
    {
        return view('menu.history');
    }
}
