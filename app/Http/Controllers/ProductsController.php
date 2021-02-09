<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Basket;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::where('available', 1)->get();
        return view('products', ['products' => $products]);
    }

    public function delete(Request $request) {
        auth()->user()->basket()->where('product_id', $request->id)->delete();
        return back();
    }

    public function orders() 
    {
        return view('orders'); 
    }
}