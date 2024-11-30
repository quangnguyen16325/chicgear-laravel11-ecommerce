<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $product_id;
    public $search = '';

    public function deleteProduct()
    {
        $product = Product::find($this->product_id);
        unlink('assets/imgs/products/'.$product->image);
        $product->delete();
        session()->flash('message','Sản phẩm đã được xóa thành công!');
    }

    public function render()
    {   
        // $products = Product::orderBy('created_at','DESC')->paginate(10);
        $products = Product::query()
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('category_id')  
        ->orderBy('updated_at', 'DESC')  
        ->paginate(10);

        foreach ($products as $product) {
            if($product->stock_status == 'instock') {
                $product->stock_status = 'Còn hàng';
            } else {
                $product->stock_status = 'Hết hàng';
            }
        }

        return view('livewire.admin.admin-product-component',['products'=> $products]);
    }
}
