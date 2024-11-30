<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class BlogComponent extends Component
{
    public function render()
    {
        $categories = Category::withCount(['products' => function ($query) {
            $query->where('category_id', '>', 0); 
        }])->orderBy("name")->get();

        return view('livewire.blog-component',['categories'=> $categories]);
    }
}
