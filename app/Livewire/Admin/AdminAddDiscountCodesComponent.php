<?php

namespace App\Livewire\Admin;

use App\Models\DiscountCode;
use Livewire\Component;

class AdminAddDiscountCodesComponent extends Component
{
    public $code;
    public $name;
    public $percentage;
    public $quantity;
    public $distributed_to_all = false;


    public function storeDiscountCode()
    {
        $this->validate([
            'code' => 'required|unique:discount_codes,code|max:20',
            'name' => 'required|max:100',
            'percentage' => 'required|numeric|min:1|max:100',
            'quantity' => 'required|numeric|min:1',
            'distributed_to_all' => 'boolean',
        ]);

        $discountCode = new DiscountCode();
        $discountCode->code = $this->code;
        $discountCode->name = $this->name;
        $discountCode->percentage = $this->percentage;
        $discountCode->quantity = $this->quantity;
        $discountCode->distributed_to_all = $this->distributed_to_all;
        $discountCode->save();

        session()->flash('message', 'Mã giảm giá đã được tạo thành công!');

        $this->reset(['code', 'name', 'percentage', 'quantity', 'distributed_to_all']);
    }
    public function render()
    {
        return view('livewire.admin.admin-add-discount-codes-component');
    }
}
