<?php

namespace App\Http\Controllers;

use Stripe\Stripe;

class PaymentController extends Controller{
    public function __construct() {
        $this->stripeSecret = config('app.stripeSecret');
        Stripe::setApiKey($this->stripeSecret);
    }

    public function checkoutView() {
        $items = [
            ['id' => 1, 'title' => 'Mythical Man-Month, The: Essays on Software Engineering', 'cost' => 23.99], 
            ['id' => 3, 'title' => 'Peopleware: Productive Projects and Teams', 'cost' => 18.94]
        ];

        $total = array_sum(array_column($items, 'cost'));

        $intent = \Stripe\PaymentIntent::create([
            'amount' => $total * 100, 'currency' => 'gbp',
        ]);

        // Client secret represents the amount to charge the user. It will be used to charge their card.
        $clientSecret = $intent->client_secret;

        // Store $paymentIntentId in the database against the order. Which will be used to confirm the payment later.
        $paymentIntentId = $intent->id;

        return view('checkout', ['clientSecret' => $clientSecret, 'paymentIntentId' => $paymentIntentId, 'items' => $items, 'total'=> $total]);
    }

    public function confirmPurchaseWithStripe() {
        $paymentIntentId = request()->input('paymentIntentId');

        if($this->isPaymentSuccessful($paymentIntentId)){
            // Update order and mark it paid
            return response('success', 200);
        }
    
        return response('failed', 500);
    }

    private function isPaymentSuccessful($paymentIntentId) {
        // Check if this token exists in the database.
        $stripeClient = new \Stripe\StripeClient($this->stripeSecret);

        $piRetrieve = $stripeClient->paymentIntents->retrieve($paymentIntentId, []);

        return $piRetrieve->status == 'succeeded';
    }
}
