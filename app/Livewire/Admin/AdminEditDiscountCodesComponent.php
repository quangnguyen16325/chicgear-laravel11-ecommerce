<?php

namespace App\Livewire\Admin;

use App\Models\DiscountCode;
use Livewire\Component;

class AdminEditDiscountCodesComponent extends Component
{
    public $discount_id;
    public $name;
    public $code;
    public $percentage;
    public $quantity;
    public $distributed_to_all;

    public function mount($discount_id)
    {
        $discountCode = DiscountCode::findOrFail($discount_id);

        $this->discount_id = $discountCode->id;
        $this->name = $discountCode->name;
        $this->code = $discountCode->code;
        $this->percentage = $discountCode->percentage;
        $this->quantity = $discountCode->quantity;
        $this->distributed_to_all = $discountCode->distributed_to_all;
    }

    public function updateDiscountCode()
    {
        $this->validate([
            'name' => 'required|max:100',
            'code' => 'required|unique:discount_codes,code,' . $this->discount_id . '|max:20',
            'percentage' => 'required|numeric|min:1|max:100',
            'quantity' => 'required|numeric|min:1',
            'distributed_to_all' => 'boolean',
        ]);

        $discountCode = DiscountCode::findOrFail($this->discount_id);
        $discountCode->name = $this->name;
        $discountCode->code = $this->code;
        $discountCode->percentage = $this->percentage;
        $discountCode->quantity = $this->quantity;
        $discountCode->distributed_to_all = $this->distributed_to_all;
        $discountCode->save();

        session()->flash('message', 'Mã giảm giá đã được cập nhật thành công!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-discount-codes-component');
    }
}
