<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Favorite;

class FavoriteController extends Controller
{
    //
    public function favoriteMenuIds()
    {
        $favorites = Favorite::where('user_id', \Auth::user()->id);

        $favoriteMenuIds = $favorites->pluck('menu_id')->all();

        return response()->json(['favoriteMenuIds' => $favoriteMenuIds]);
    }

    public function show()
    {
        return view('menu.favorite');

    }

    public function addRemove(Request $request, Menu $menu)
    {
        $favorite = Favorite::where([
            'user_id' => $request->user()->id,
            'menu_id' => $menu->id,
        ])->first();

        if ($favorite) {
            $favorite->delete();

            $action = 'remove';
        } else {
            Favorite::create([
                'user_id' => $request->user()->id,
                'menu_id' => $menu->id,
            ]);

            $action = 'add';
        }

        return response()->json(['action' => $action]);

    }

    public function destory(Request $request)
    {
        Favorite::where('user_id', $request->user()->id)
            ->whereIn('menu_id', $request['menuIds'])
            ->delete();

        return response()->json();
    }

}

