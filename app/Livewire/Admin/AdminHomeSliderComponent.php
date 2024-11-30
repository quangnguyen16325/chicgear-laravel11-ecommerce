<?php

namespace App\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Illuminate\Support\Facades\File;

class AdminHomeSliderComponent extends Component
{
    public $slide_id;

    public function deleteSlide()
    {
        $slide = HomeSlider::find($this->slide_id);
        // unlink('assets/imgs/slider/'.$slide->img);
        // $slide->delete();
        // session()->flash('message','Trình chiếu đã được xóa thành công!');
        if ($slide) 
        { 
            $imagePath = public_path('assets/imgs/slider/' . $slide->image); 
            if (File::exists($imagePath)) { 
                File::delete($imagePath); 
            } 
            $slide->delete(); 
            session()->flash('message', 'Trình chiếu đã được xóa thành công!'); 
            } else { 
                session()->flash('error', 'Trình chiếu không tồn tại!'); 
            }
    }

    public function render()
    {
        $slides = HomeSlider::orderBy("created_at","desc")->get();
        return view('livewire.admin.admin-home-slider-component',['slides'=>$slides]);
    }
}
