<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Forms\PersonForm;
use App\Menu;
use App\Size;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Forms\MenuForm;
use App\Forms\ProductForm;
use App\Http\Controllers\Controller;   // 追加

class AdminController extends Controller
{
    //
    use FormBuilderTrait;

    public function index()
    {
        $menus = Menu::all();

        return view('admin.index', compact('menus'));
    }

    public function create()
    {
        $form = $this->form(MenuForm::class);

        return view('admin.create', compact('form'));
    }

    public function store(){

        $form = $this->form(MenuForm::class);

        if (!$form->isValid($form)){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->save();

        return redirect(route('admin.menu_index'));
    }
    public function edit($id)
    {
        $menu = Menu::find($id);

        $form = $this->form(MenuForm::class, ['model'=>$menu]);

        return view('admin.edit', compact('form', 'menu'));
    }


    public function update($id)
    {
        $menu = Menu::find($id);

        $form = $this->form(MenuForm::class, ['model'=>$menu]);

        if (!$form->isValid($form)){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $form->save();

        return redirect(route('admin.menu_index'));

    }

    public function product($id)
    {
        $menu = Menu::find($id);
        $rows = \DB::table('sizes as s')
            ->leftjoin('products as p',function ($join) use($id) {
                $join->on('s.id', '=', 'p.size_id')
                    ->where('p.menu_id', '=' , $id)
                    ->whereNull('deleted_at');
            })
            ->select('s.name as size', 'p.price as price', 's.id as size_id', 'p.id as product_id')
            ->get();
        return view('admin.product', compact('menu', 'rows'));
    }

    public function storeProduct($id, Request $request)
    {
        foreach ($request['products'] as $product) {
            if ($product['flag'] == 1) {
                if (empty($product['product_id'])) {
                    Product::create([
                        'menu_id' => $id,
                        'size_id' => $product['size_id'],
                        'price' => $product['price'],
                    ]);
                } elseif (empty($product['price'])) {
                        product::where('id', $product['product_id'])
                            ->delete();
                } else {
                        product::where('id', $product['product_id'])
                            ->update(['price' => $product['price']]);
                };
            };
        };
        return redirect(route('admin.menu_product', ['id' => $id]));
    }

    public function storeProductAll($id, Request $request)
    {
        logger($request);
        foreach ($request['products'] as $product) {
logger($product['product_id']);
logger($product['price']);

                if (empty($product['product_id']) && isset($product['price'])) {
                    Product::create([
                        'menu_id' => $id,
                        'size_id' => $product['size_id'],
                        'price' => $product['price'],
                    ]);
                } elseif (isset($product['product_id']) && empty($product['price'])) {
                    product::where('id', $product['product_id'])
                        ->delete();
                } elseif (isset($product['product_id']) && isset($product['price'])) {
                    product::where('id', $product['product_id'])
                        ->update(['price' => $product['price']]);
                };
        };
        return redirect(route('admin.menu_product', ['id' => $id]));
    }
}
