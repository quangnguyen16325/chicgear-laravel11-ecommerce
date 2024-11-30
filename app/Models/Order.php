<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'fullname',
        'email',
        'phone',
        'order_notes',
        'total',
        'status',
        'payment_option',
        'order_code',
        'tax_percentage',
        'admin_confirmed', 
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_code)) {
                // Tạo mã đơn hàng 
                $order->order_code = 'OD-' . strtoupper(bin2hex(random_bytes(4))); // Mã ngẫu nhiên dài 8 ký tự
            }
        });
    }

    protected static function booted()
    {
        static::updating(function ($order) {
            if ($order->isDirty('status')) { // Kiểm tra nếu 'status' thay đổi
                $order->status_updated_at = now();
            }
        });
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function histories()
    {
        return $this->hasMany(OrderHistory::class);
    }

    // Lưu thông tin vào bảng order_histories và order_history_items
    public function updateStatusAndHistory($newStatus)
    {
        // Tạo lịch sử cho đơn hàng trong bảng order_histories
        $history = OrderHistory::create([
            'order_code' => $this->order_code,
            'user_id' => $this->user_id,
            'shipping_address_id' => $this->shipping_address_id,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'order_notes' => $this->order_notes,
            'payment_option' => $this->payment_option,
            'tax_percentage' => $this->tax_percentage,
            'total' => $this->total,
            'status' => $newStatus,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Lưu các sản phẩm trong đơn hàng vào bảng order_history_items
        foreach ($this->items as $item) {
            OrderHistoryItem::create([
                'order_history_id' => $history->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product_name,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Cập nhật trạng thái của đơn hàng
        $this->status = $newStatus;
        $this->save();
    }
}
