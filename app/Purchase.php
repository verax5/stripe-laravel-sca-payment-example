<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity', 'stripe_payment_intent_id'];

    public function product() 
    {
        return $this->belongsTo(Product::class);
    }
}