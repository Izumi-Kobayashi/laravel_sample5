<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\ProductEditComposer;
use App\Http\ViewComposers\OrderViewComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \View::composer('admin.product', ProductEditComposer::class);
        \View::composer('admin.sale', OrderViewComposer::class);
    }
}
