<?php

namespace App\Livewire\User;

use App\Models\OrderHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserOrderHistoryDetailsComponent extends Component
{
    public $orderId;
    public $order;

    public function mount($orderId)
    {
        $this->orderId = $orderId;

        $this->order = OrderHistory::with('items.product')
            ->where('id', $this->orderId)
            ->where('user_id', Auth::id()) 
            ->firstOrFail(); 
    }

    public function confirmOrder($order_code)
    {
        $order = OrderHistory::where('order_code', $order_code)->first();
        
        if ($order && $order->status == 'expired_confirmed') {
            $order->status = 'user_confirmed';
            $order->save();

            $this->order = $order;

            // Phát sự kiện để hiển thị thông báo
            session()->flash('success', 'Đơn hàng đã được xác nhận.');
        }
    }

    public function render()
    {
        return view('livewire.user.user-order-history-details-component', [
            'order' => $this->order,
        ]);
    }
}
