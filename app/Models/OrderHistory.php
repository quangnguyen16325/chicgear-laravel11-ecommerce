<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'order_code',
        'shipping_address_id',
        'phone',
        'fullname',
        'email',
        'user_id',
        'status',
        'total',
        'payment_option',
        'created_at',
        'tax_percentage',
    ];

    public function items()
    {
        return $this->hasMany(OrderHistoryItem::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
