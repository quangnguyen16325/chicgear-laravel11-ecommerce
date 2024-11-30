<?php

namespace App\Livewire;

use Livewire\Component;
// use Cart;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{

    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->dispatch('refreshComponent')->to('cart-icon-component');
        // $this->emit('refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->dispatch('refreshComponent')->to('cart-icon-component');
    }

    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);
        $this->dispatch('refreshComponent')->to('cart-icon-component');
        session()->flash('success_message', 'Sản phẩm đã được xóa!');
    }

    public function clearAll()
    {
        Cart::instance('cart')->destroy();
        $this->dispatch('refreshComponent')->to('cart-icon-component');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
