<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function basket() {
        return $this->hasMany(Basket::class);
    }

    public function purchases() 
    {
        return $this->hasMany(Purchase::class);
    }

    public function getBasketTotal() {
        $total = 0;
        
        foreach($this->basket as $basket) {
            $total = $total + $basket->product->cost * $basket->quantity;
        }

        return $total;
    }
}
