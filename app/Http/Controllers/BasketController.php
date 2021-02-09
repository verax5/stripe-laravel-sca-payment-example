<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basket;

class BasketController extends Controller
{
    public function add(Request $request) {
        $basket = Basket::where('user_id', auth()->user()->id)->where('product_id', $request->productId)->first();

        if($basket) {
            $basket->increment('quantity');
            $basket->save();
        } else {
            Basket::create(['user_id' => auth()->user()->id, 'product_id' => $request->productId, 'quantity' => 1]);
        }

        return back();
    }
}
