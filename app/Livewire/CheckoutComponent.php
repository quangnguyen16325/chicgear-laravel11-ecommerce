<?php

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB; 

class CheckoutComponent extends Component
{
    public $fullname;
    public $email;
    public $selectedAddress;
    public $addresses;
    public $paymentOption;
    public $order_notes;

    public function mount()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); 
        }

        $this->fullname = $user->name;
        $this->email = $user->email;
        $this->addresses = Address::where('user_id', $user->id)->get();

        $defaultAddress = $this->addresses->where('is_default', 1)->first();
        $this->selectedAddress = $defaultAddress ? $defaultAddress->id : ($this->addresses->first()->id ?? null);
    }

    public function storeOrder()
    {
        $this->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'paymentOption' => 'required|in:cod,card,momo',
            'selectedAddress' => 'required|integer|exists:addresses,id',
        ]);

        foreach (Cart::instance('cart')->content() as $item) {
            $product = Product::find($item->id);
            if (!$product || $product->quantity < $item->qty) {
                session()->flash('error_message', "Sản phẩm '{$item->name}' đã hết hàng hoặc không đủ số lượng.");
                return;
            }
        }

        $taxPercentage = config('cart.tax') ;
        $total = floatval(str_replace(',', '', Cart::instance('cart')->total()));

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'shipping_address_id' => $this->selectedAddress,
                'fullname' => $this->fullname,
                'email' => $this->email,
                'order_notes' => $this->order_notes,
                'payment_option' => $this->paymentOption, 
                'total' => $total, 
                'status' => 'pending',
                'tax_percentage' => $taxPercentage,
            ]);

            // dd($order);

            foreach (Cart::instance('cart')->content() as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price,
                ]);

                $product = Product::find($item->id);
                if ($product) {
                    $product->update([
                        'quantity' => $product->quantity - $item->qty,
                        'sold_quantity' => $product->sold_quantity + $item->qty,
                    ]);
                }
            }

            Cart::instance('cart')->destroy();

            DB::commit();

            return redirect()->route('thankyou')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollback();
    
            return redirect()->route('thankyou')->with('success', 'Đặt hàng thất bại!');
        }
    }

    public function render()
    {
        return view('livewire.checkout-component');
    } 
}
