<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'total_products',
        'total_price',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
