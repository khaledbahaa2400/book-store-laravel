<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function totalPrice($cartItems)
    {
        $price = 0;
        foreach ($cartItems as $cartItem) :
            $price += $cartItem->product->price * $cartItem->quantity;
        endforeach;
        return $price;
    }
}
