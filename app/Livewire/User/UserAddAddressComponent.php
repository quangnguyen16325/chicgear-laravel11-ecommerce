<?php

namespace App\Livewire\User;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAddAddressComponent extends Component
{
    public $address;
    public $phone;
    public $is_default = false;

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName, [
    //         'address' => 'required|string|max:255',
    //         'phone' => 'required|digits_between:10,15',
    //     ]);
    // }

    public function saveAddress()
    {
        $this->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,15',
        ]);

        $isFirstAddress = Address::where('user_id', Auth::id())->doesntExist();

        if ($this->is_default) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        Address::create([
            'user_id' => Auth::id(),
            'address' => $this->address,
            'phone' => $this->phone,
            'is_default' => $isFirstAddress || $this->is_default,
        ]);

        session()->flash('message', 'Thêm địa chỉ thành công!');
        return redirect()->route('user.profile');
    }
    public function render()
    {
        return view('livewire.user.user-add-address-component');
    }
}
