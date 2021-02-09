<?php

use Illuminate\Support\Facades\Route;


Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@check');

Route::middleware(['auth'])->group(function(){
    Route::get('checkout', 'PaymentController@checkout');
    Route::post('store-order', 'PaymentController@storeOrder');
    
    Route::get('products', 'ProductsController@index');
    Route::delete('products/delete', 'ProductsController@delete');
    
    Route::get('orders', 'ProductsController@orders');

    Route::post('add-basket', 'BasketController@add');
    Route::get('logout', 'LoginController@logout');
});
