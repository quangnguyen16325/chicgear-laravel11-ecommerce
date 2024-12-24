<?php

namespace App\Livewire\Admin;

use App\Models\DiscountCode;
use Livewire\Component;
use Livewire\WithPagination;

class AdminDiscountCodesComponent extends Component
{
    public $discount_id, $code, $name, $percentage, $quantity, $search = '';
    public $editMode = false;
    use WithPagination;

    public function deleteDiscountCode()
    {
        $discountCode = DiscountCode::find($this->discount_id);

        if ($discountCode) {
            $discountCode->users()->detach(); 

            $discountCode->delete();
            session()->flash('message', 'Mã giảm giá đã được xóa thành công!');
        }
    }

    public function toggleStatus($discountCodeId)
    {
        $discountCode = DiscountCode::findOrFail($discountCodeId);
    
        $discountCode->is_active = !$discountCode->is_active;
        $discountCode->save();

        session()->flash('message', 'Trạng thái mã giảm giá đã được cập nhật!');
    }
    public function render()
    {
        // $discountCodes = DiscountCode::with('users')->paginate(10);
        $discountCodes = DiscountCode::where('code', 'like', '%' . $this->search . '%')
                                 ->orWhere('name', 'like', '%' . $this->search . '%')
                                 ->paginate(10);

        return view('livewire.admin.admin-discount-codes-component',[
            'discountCodes' => $discountCodes,
        ]);
    }
}
