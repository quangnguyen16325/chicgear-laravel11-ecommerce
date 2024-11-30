<?php

namespace App\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class AdminEditHomeSlideComponent extends Component
{
    use WithFileUploads;
    public $top_title;
    public $title;
    public $sub_title;
    public $offer;
    public $link;
    public $status = 1;
    public $image;
    public $slide_id;
    public $newImage;

    public function mount($slide_id)
    {
        $slide = HomeSlider::find($slide_id);
        $this->top_title = $slide->top_title;
        $this->title = $slide->title;
        $this->sub_title = $slide->sub_title;
        $this->offer = $slide->offer;
        $this->link = $slide->link;
        $this->status = $slide->status;
        $this->image = $slide->image;
        $this->slide_id = $slide->id;
    }

    public function updateSlide()
    {
        $this->validate([
            'top_title' => 'required',
            'title' => 'required',
            'sub_title' => 'required',
            'offer' => 'required',
            'link' => 'required',
            'status' => 'required',
            'newImage' => 'nullable|image|max:1024',

        ]);

        $slide = HomeSlider::find($this->slide_id);
        $slide->top_title = $this->top_title;
        $slide->title = $this->title;
        $slide->sub_title = $this->sub_title;
        $slide->offer = $this->offer;
        $slide->link = $this->link;
        $slide->status = $this->status;
        // if($this->newImage)
        // {
        //     unlink('assets/imgs/slider/'.$slide->img);
        //     $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
        //     $this->newImage->storeAs('slider', $imageName);
        //     $slide->image = $imageName;
        // }
        if ($this->newImage) 
        { 
            $imagePath = public_path('assets/imgs/slider/' . $slide->image); 
                if (File::exists($imagePath)) { 
                    File::delete($imagePath); 
                } 
                $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
                $this->newImage->storeAs('slider', $imageName); 
                $slide->image = $imageName; 
            }
        $slide->save();
        session()->flash('message','Trình chiếu đã được cập nhật thành công!');
    }
    public function render()
    {
        
        return view('livewire.admin.admin-edit-home-slide-component');
    }
}
