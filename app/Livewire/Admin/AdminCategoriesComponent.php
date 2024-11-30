<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class AdminCategoriesComponent extends Component
{ 
    public $category_id;
    public $search = ''; 
    use WithPagination;

    public function deleteCategory()
    {
        $category = Category::find($this->category_id);
        $imagePath = public_path('assets/imgs/categories/' . $category->image); 
            if (File::exists($imagePath)) { 
                File::delete($imagePath); 
            } 
        $category->delete();
        session()->flash('message','Danh mục đã được xóa thành công!');
    }

    public function render()
    {
        // $categories = Category::orderBy('name', 'ASC')->paginate(5);
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
                              ->orderBy('name', 'ASC')
                              ->paginate(10);
        
        return view('livewire.admin.admin-categories-component',['categories'=>$categories]);
    }
}
