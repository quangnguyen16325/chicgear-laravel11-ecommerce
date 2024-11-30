<?php

namespace App\Livewire\User;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderHistoryItem;
use Livewire\Component;

class UserOrderComponent extends Component
{
    public $orderIdToCancel; 

    // public function confirmCancelOrder($orderId)
    // {
    //     $this->orderIdToCancel = $orderId; 
    // }

    public function cancelOrder()
    {
        $order = Order::find($this->orderIdToCancel); 

        if ($order && $order->status == 'pending') {
            $orderHistory = OrderHistory::create([
                'order_code' => $order->order_code,
                'user_id' => $order->user_id,
                'shipping_address_id' => $order->shipping_address_id,
                'total' => $order->total,
                'fullname' => $order->fullname,
                'email' => $order->email,
                'payment_option' => $order->payment_option,
                'created_at' => now(),
                'tax_percentage' => $order->tax_percentage,
                'status' => 'canceled', 
            ]);

            foreach ($order->items as $item) {
                OrderHistoryItem::create([
                    'order_history_id' => $orderHistory->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            $order->status = 'canceled';
            $order->save();

            $this->orderIdToCancel = null;
            session()->flash('message', 'Đơn hàng đã được hủy.');
        }
    }
    public function confirmReceived($orderId)
    {
        // $order = Order::find($orderId);
        // if ($order && $order->status == 'delivered') {
        //     $order->status = 'user_confirmed';
        //     $order->save();
        //     session()->flash('message', 'Đơn hàng đã được xác nhận.');
        // }
        $order = Order::find($orderId);
        
        if ($order && $order->status == 'delivered') {
            $orderHistory = OrderHistory::create([
                'order_code' => $order->order_code,
                'user_id' => $order->user_id,
                'shipping_address_id' => $order->shipping_address_id,
                'total' => $order->total,
                'fullname' => $order->fullname,
                'email' => $order->email,
                'payment_option' => $order->payment_option,
                'created_at' => now(),
                'tax_percentage' => $order->tax_percentage,
                // 'status' => $order->status, 
                'status'=> 'user_confirmed',
            ]);

            foreach ($order->items as $item) {
                OrderHistoryItem::create([
                    'order_history_id' => $orderHistory->id, 
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
            }

            $order->status = 'user_confirmed';
            $order->save();

            session()->flash('message', 'Đơn hàng đã được xác nhận nhận hàng.');
        }
    }

    public function render()
    {
        // $orders = Order::where('user_id', auth()->id())->get();
        $orders = Order::where('user_id', auth()->id())
                ->whereNotIn('status', ['canceled', 'user_confirmed','expired_confirmed']) // Loại bỏ đơn hàng đã hủy hoặc đã xác nhận
                ->orderByRaw("CASE WHEN status = 'delivered' THEN 0 ELSE 1 END") // Đưa status 'delivered' lên đầu
                ->orderBy('created_at', 'desc')
                ->get();

        return view('livewire.user.user-order-component',['orders'=> $orders]);
    }

    
}
