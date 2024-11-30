<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB; 

class OrderController extends Controller
{
    public $paymentOption;
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|integer|exists:addresses,id', 
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment_option' => 'required|in:cod,card,momo', 
            'paymentOption' => 'required|in:cod,card,momo',
        ]);

        $request->merge([
            'shipping_address_id' => (int) $request->input('shipping_address_id'),
        ]);

        $total = floatval(str_replace(',', '', Cart::instance('cart')->total()));

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'shipping_address_id' => $request->input('shipping_address_id'), 
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'order_notes' => $request->input('order_notes'),
                'payment_option' => $request->input('payment_option'), 
                'total' => $total, 
            ]);
            // dd($order);

            foreach (Cart::instance('cart')->content() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);
            }

            Cart::instance('cart')->destroy();

            DB::commit();

            return redirect()->route('thankyou')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
    
            return back()->with('error', 'Đặt hàng thất bại!')->withInput();
        }
    }
}