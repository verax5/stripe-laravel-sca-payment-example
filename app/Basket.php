<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
