<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'shoe_product_id',
        'quantity',
        'total_amount',
        'status',
    ];

    // Each order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each order belongs to a shoe product
    public function shoeProduct()
    {
        return $this->belongsTo(ShoeProduct::class);
    }

    //Each order has one payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
