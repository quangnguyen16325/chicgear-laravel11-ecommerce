<?php

namespace App\Livewire\Admin;

use App\Models\DiscountCode;
use Livewire\Component;

class AdminDiscountCodesDetailsComponent extends Component
{
    public $discountCode;

    public function mount($discount_id)
    {
        $this->discountCode = DiscountCode::findOrFail($discount_id);
    }
    public function render()
    {
        return view('livewire.admin.admin-discount-codes-details-component');
    }
}
