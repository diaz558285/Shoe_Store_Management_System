<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount_paid',
        'balance',
        'status',
    ];

    // Each payment belongs to an order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
