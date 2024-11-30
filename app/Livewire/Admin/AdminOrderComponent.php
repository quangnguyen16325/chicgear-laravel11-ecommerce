<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderItem;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderComponent extends Component
{
    use WithPagination;
    public $order_id;
    public $search = '';

    public function mount()
    {
       
    }

    public function changeStatus($orderId, $newStatus)
    {
        $order = Order::find($orderId);
        if ($order) {
            // Nếu trạng thái là 'completed', thực hiện xóa các bản ghi liên quan
            if ($newStatus === 'completed') {
                // Xóa các bản ghi trong bảng order_items liên quan đến orderId
                $orderHistory = OrderHistory::where('order_code', $order->order_code)->first();
                if ($orderHistory) {
                    $orderHistory->admin_confirmed = true;
                    $orderHistory->save();
                } 
                
                OrderItem::where('order_id', $orderId)->delete();

                // Xóa bản ghi trong bảng orders
                $order->delete();

                session()->flash('message', 'Đã lưu lịch sử đơn hàng thành');
            }else{
                $order->status = $newStatus;
                $order->save();
                session()->flash('message', 'Trạng thái đơn hàng đã được cập nhật!');
            }
        }
    }

    public function deleteOrder($orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            $orderHistory = OrderHistory::where('order_code', $order->order_code)->first();
            if ($orderHistory) {
                $orderHistory->admin_confirmed = true; 
                $orderHistory->save(); 
            }

            OrderItem::where('order_id', $orderId)->delete();

            $order->delete();

            session()->flash('message', 'Đã lưu lại lịch sử đơn hàng.');
        } else {
            session()->flash('error', 'Không tìm thấy đơn hàng để xóa.');
        }
    }


    public function updateOrderStatus()
    {
        // Lấy tất cả đơn hàng có trạng thái 'delivered' và đã quá hạn 1 ngày
        $orders = Order::where('status', 'delivered')
                        ->where('status_updated_at', '<', now()->subDay())
                        ->get();

        // Lặp qua từng đơn hàng và thực hiện cập nhật trạng thái và lưu lịch sử
        foreach ($orders as $order) {
            $order->updateStatusAndHistory('expired_confirmed');
        }

        session()->flash('message', 'Trạng thái các đơn hàng đã được cập nhật!');
    }

    public function render()
    {
        // $orders = Order::orderByRaw("
        //     FIELD(status, 'delivered', 'user_confirmed', 'expired_confirmed', 'canceled') DESC
        // ")
        // ->orderBy('created_at', 'desc')
        // ->paginate(10);
        $orders = Order::query()
                ->where('order_code', 'like', '%' . $this->search . '%') 
                ->orWhere('fullname', 'like', '%' . $this->search . '%') 
                ->orderByRaw("
                    FIELD(status, 'delivered', 'user_confirmed', 'expired_confirmed', 'canceled') DESC
                ")
                ->orderBy('created_at', 'desc')
                ->paginate(10);

        return view('livewire.admin.admin-order-component',['orders'=>$orders]);
    }
}
