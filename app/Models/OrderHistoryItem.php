<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistoryItem extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'order_history_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
    ];

    public function orderHistory()
    {
        return $this->belongsTo(OrderHistory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
