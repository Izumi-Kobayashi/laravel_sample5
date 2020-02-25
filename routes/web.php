<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('hello','HelloController@index');

Route::get('people', 'PersonController@index') -> name('person_index');
Route::get('people/create', 'PersonController@create') -> name('person_create');
Route::post('people', 'PersonController@store') -> name('person_store');
Route::get('people/{id}', 'PersonController@show') -> name('person_show');
Route::get('people/{id}/edit', 'PersonController@edit') -> name('person_edit');
Route::put('people/{id}', 'PersonController@update') -> name('person_update');
Route::delete('people/{id}', 'PersonController@destroy') -> name('person_destroy');

Route::get('questions', 'QuestionController@index') -> name('question_index');
Route::get('questions/{id}', 'QuestionController@show') -> name('question_show');
Route::post('questions/{id}/vote', 'QuestionController@vote') -> name('question_vote');
Route::get('questions/{id}/results', 'QuestionController@result') -> name('question_result');

Route::group(['prefix' => 'admin','middleware' => 'guest:admin'], function() {
    Route::get('login',     'Admin\Auth\LoginController@showLoginForm')->name('admin.show_login_form');
    Route::post('login',    'Admin\Auth\LoginController@login')->name('admin.login');
});
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('admin/calendar/{month}', 'Admin\AdminController@showCalendar')->name('admin.calendar');
    Route::get('admin/menus', 'Admin\AdminController@index')->name('admin.menu_index');
    Route::get('admin/menus/create', 'Admin\AdminController@create')->name('admin.menu_create');
    Route::post('admin/menus', 'Admin\AdminController@store')->name('admin.menu_store');
    Route::get('admin/menus/{id}/edit', 'Admin\AdminController@edit')->name('admin.menu_edit');
    Route::get('admin/menus/{menu}/product', 'Admin\AdminController@product')->name('admin.menu_product');
    Route::post('admin/menus/{menu}/product/store', 'Admin\AdminController@storeProduct')->name('admin.menu_store_product');
    Route::post('admin/menus/{id}/product/all', 'Admin\AdminController@storeProductAll')->name('admin.menu_store_product_all');
    Route::put('admin/menus/{id}', 'Admin\AdminController@update')->name('admin.menu_update');
    Route::get('admin/sales', 'Admin\AdminController@sale')->name('admin.total_sale');
    Route::get('admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});


Route::group(['middleware' => 'guest'] , function () {
        Route::get('login', 'LoginController@showLoginForm')->name('show_login_form');
        Route::post('login', 'LoginController@login')->name('login');
        Route::get('user', 'UserController@showUserForm')->name('show_user_form');
        Route::post('user', 'UserController@create')->name('user_create');
});

Route::group(['middleware' => 'auth:user'], function () {
    Route::get('menus', 'MenuController@index')->name('menu_index');
    Route::get('menus/{id}', 'MenuController@show')->where('id', '[0-9]+')->name('menu_show');
    Route::post('menus/confirm', 'MenuController@confirm')->name('menu_confirm');
    Route::post('menus/order', 'MenuController@order')->name('menu_order');
    Route::get('menus/history', 'MenuController@history')->name('menu_history');
    Route::get('menus/{id}/post', 'MenuController@post')->where('id', '[0-9]+')->name('menu_post');
    Route::post('menus/store/{menu}', 'MenuController@store')->where('menu', '[0-9]+')->name('menu_store');
    Route::get('favorite', 'FavoriteController@show')->where('id', '[0-9]+')->name('favorite_show');
    Route::get('favorite-menus', 'FavoriteController@favoriteMenuIds');
    Route::post('favorite-menus/{menu}', 'FavoriteController@addRemove')->where('id', '[0-9]+');
    Route::get('logout', 'LoginController@logout')->name('logout');
});
