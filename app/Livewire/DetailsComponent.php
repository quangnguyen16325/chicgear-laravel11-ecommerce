<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
// use Cart;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $slug;
    public $min_value = 0;
    public $max_value = 10000000;

    public function mount($slug){
        $this->slug = $slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        $product = Product::find($product_id);

        if ($product && $product->quantity > 0) {
            Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
            session()->flash('success_message', 'Sản phẩm đã được thêm vào giỏ hàng');
            $this->dispatch('refreshComponent')->to('cart-icon-component');
        } else {
            session()->flash('error_message', 'Sản phẩm đã hết hàng');
        }
        
        // Cart::instance('cart')->add($product_id, $product_name,1, $product_price)->associate('\App\Models\Product');
        // session()->flash('success_message', 'Sản phẩm đã được thêm vào giỏ hàng');
        // $this->dispatch('refreshComponent')->to('cart-icon-component');
        // return redirect()->route('shop.cart');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name,1, $product_price)->associate('App\Models\Product');
        $this->dispatch('refreshComponent')->to('wishlist-icon-component');
    }

    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if($witem->id==$product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->dispatch('refreshComponent')->to('wishlist-icon-component');
                return;
            }
        }
    }

    public function render()
    {
        $categories = Category::orderBy('name','ASC')->get();
        $product = Product::where('slug', $this->slug)->first();
        $rproducts = Product::where('category_id', $product->category_id)
                            ->inRandomOrder()
                            ->limit(4)
                            ->get();
        $nproducts = Product::latest()->take(4)->get();
        return view('livewire.details-component', [
                'product'=> $product,
                'rproducts' => $rproducts,
                'nproducts'=> $nproducts,
                'categories' => $categories,
            ]);
    }
}
