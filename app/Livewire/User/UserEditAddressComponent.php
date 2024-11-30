<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class UserEditAddressComponent extends Component
{
    public $addresses;
    public $phone;
    public $address;
    public $address_id;
    public $is_default;

    public function mount($address_id)
    {
        $user = Auth::user();
        $this->address_id = $address_id;

        $address = Address::where('user_id', $user->id)->where('id', $address_id)->first();

        if ($address) {
            $this->address = $address->address;
            $this->phone = $address->phone;
            $this->is_default = $address->is_default; 
        }
    }

    public function updateAddress()
    {
        $this->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $user = Auth::user();
        $address = Address::find($this->address_id);

        if ($this->is_default) {
            Address::where('user_id', $user->id)->update(['is_default' => false]); 
        }

        $address->update([
            'address' => $this->address,
            'phone' => $this->phone,
            'is_default' => $this->is_default, 
        ]);

        session()->flash('message', 'Thông tin địa chỉ và số điện thoại đã được cập nhật!');
    }
    public function render()
    {
        return view('livewire.user.user-edit-address-component');
    }
}
