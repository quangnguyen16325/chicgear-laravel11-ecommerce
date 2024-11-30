<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\OrderHistoryItem;
use Carbon\Carbon;

class AutoConfirmOrder extends Command
{
    // protected $signature = 'orders:auto-confirm';
    // protected $description = 'Automatically confirm delivered orders after 1 day if not confirmed by the user';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-confirm-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Lấy các đơn hàng đã giao quá 1 ngày nhưng chưa được xác nhận
    //     $orders = Order::where('status', 'delivered')
    //     ->where('updated_at', '<', Carbon::now()->subDay()) 
    //     ->get();

    // foreach ($orders as $order) {
    //     $order->status = 'user_confirmed';
    //     $order->save();

    //     $orderHistory = OrderHistory::create([
    //         'order_code' => $order->order_code,
    //         'user_id' => $order->user_id,
    //         'shipping_address_id' => $order->shipping_address_id,
    //         'total' => $order->total,
    //         'fullname' => $order->fullname,
    //         'email' => $order->email,
    //         'payment_option' => $order->payment_option,
    //         'created_at' => now(),
    //         'tax_percentage' => $order->tax_percentage,
    //         'status' => 'user_confirmed',
    //     ]);

    //     foreach ($order->items as $item) {
    //         OrderHistoryItem::create([
    //             'order_history_id' => $orderHistory->id,
    //             'product_id' => $item->product_id,
    //             'product_name' => $item->product->name,
    //             'quantity' => $item->quantity,
    //             'price' => $item->price,
    //         ]);
    //     }
    // }

    // $this->info('Delivered orders older than 1 day have been automatically confirmed.');
    }
}
