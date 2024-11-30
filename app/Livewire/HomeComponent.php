<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeComponent extends Component
{

    public function store($product_id, $product_name, $product_price)
    {
        $product = Product::find($product_id);

        if ($product && $product->quantity > 0) {
            Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
            session()->flash('success_message', 'Thành công | Sản phẩm đã được thêm vào giỏ hàng');
            $this->dispatch('refreshComponent')->to('cart-icon-component');
            return redirect()->route('shop.cart');
        } else {
            session()->flash('success_message', 'Sản phẩm đã hết hàng');
            return redirect()->route('shop.cart');
        }

        // Cart::instance('cart')->add($product_id, $product_name,1, $product_price)->associate('\App\Models\Product');
        // session()->flash('success_message', 'Sản phẩm đã được thêm vào giỏ hàng');
        // $this->dispatch('refreshComponent');
        // return redirect()->route('shop.cart');
    }
    
    public function render()
    {
        $slides = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at','DESC')->take(8)->get();
        $fproducts = Product::where('featured',1)->inRandomOrder()->take(8)->get();
        $pcategories = Category::where('is_popular',1)->inRandomOrder()->take(8)->get();
        $topSellingProducts = Product::orderBy('sold_quantity', 'DESC')->take(8)->get();
        return view('livewire.home-component',[
            'slides'=>$slides,
            'lproducts'=>$lproducts,
            'fproducts'=>$fproducts,
            'pcategories'=>$pcategories,
            'topSellingProducts' => $topSellingProducts,
        ]);
    }
}
