<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin;

use App\Forms\PersonForm;
use App\Menu;
use App\Services\ProductUpdateService;
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
        $menus = Menu::orderby('id', 'asc')->paginate(3);

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

    public function product(Menu $menu)
    {
        return view('admin.product', compact('menu'));
    }

    public function storeProduct(ProductUpdateService $service, Menu $menu)
    {
        $service->update();

        return redirect(route('admin.menu_product', ['menu' => $menu->id]));
    }

    public function sale()
    {
        return view('admin.sale');
    }
}
