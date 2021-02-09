<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Basket;
use App\Purchase;

class PaymentController extends Controller{
    public function __construct() {
        $this->stripeSecret = config('app.stripeSecret');
        Stripe::setApiKey($this->stripeSecret);
    }

    public function checkout() 
    {
        if (!auth()->user()->basket()->exists()) {
            return 'No items in the basket'; 
        }

        $total = auth()->user()->getBasketTotal();

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $total * 100, 'currency' => 'gbp',
        ]);

        // Client secret represents the amount to charge the user. It will be used to charge their card and payment verification later.
        $clientSecret = $intent->client_secret;

        $basket = auth()->user()->basket()->update(['stripe_payment_intent_id' => $intent->id]);

        return view('checkout', ['clientSecret' => $clientSecret, 'paymentIntentId' => $intent->id, 'total'=> $total]);
    }

    public function storeOrder() 
    {
        // Move info from basket to transactions table.
        $basket = auth()->user()->basket;

        foreach($basket as $item) {
            $data = [
                'user_id' => $item->user_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'stripe_payment_intent_id' => $item->stripe_payment_intent_id
            ];

            Purchase::create($data);
        }

        auth()->user()->basket()->delete();
        
        return redirect('orders');
    }
}
