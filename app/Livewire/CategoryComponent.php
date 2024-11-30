<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Cart;

class CategoryComponent extends Component
{
    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Mặc định"; 
    public $slug;
    public $min_value = 0;
    public $max_value = 10000000;

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
        // Cart::add($product_id, $product_name,1, $product_price)->associate('\App\Models\Product');
        // session()->flash('success_message', 'Sản phẩm đã được thêm vào giỏ hàng');
        // return redirect()->route('shop.cart');
    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function mount($slug)
    {
        $this->slug = $slug;
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
        $category = Category::where('slug', $this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        if($this->orderBy == 'Giá: Thấp đến Cao')
        {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Giá: Cao đến Thấp')
        {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Mới nhất')
        {
            $products = Product::where('category_id', $category_id)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else{
            $products = Product::where('category_id', $category_id)->paginate($this->pageSize);  
        }
        $categories = Category::orderBy('name','ASC')->get();
        $nproducts = Product::latest()->take(3)->get();
        return view('livewire.category-component', [
            'products' => $products, 
            'categories' => $categories, 
            'category_name' => $category_name,
            'nproducts'=> $nproducts,
        ]);
    }
}
