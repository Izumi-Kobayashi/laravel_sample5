<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    //
    public function showUserForm()
    {

        return view('user.user');
    }

    public function create(UserRequest $request)
    {
        $attributes = $request->all();

        $attributes['password'] = \Hash::make($attributes['password']);

        $user = User::create($attributes);

        \Auth::guard()->login($user);

        return redirect()->route('menu_index');
    }
}
