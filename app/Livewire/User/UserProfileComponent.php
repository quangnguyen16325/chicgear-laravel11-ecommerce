<?php

namespace App\Livewire\User;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserProfileComponent extends Component
{
    public $address_id;
    
    public function deleteAddress()
    {
        $address = Address::where('id', $this->address_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$address) {
            session()->flash('error', 'Địa chỉ không tồn tại hoặc bạn không có quyền xóa.');
            return;
        }

        // Nếu địa chỉ là mặc định, chọn địa chỉ khác làm mặc định 
        if ($address->is_default) {
            $nextDefault = Address::where('user_id', Auth::id())
                ->where('id', '!=', $this->address_id)
                ->first();
            if ($nextDefault) {
                $nextDefault->update(['is_default' => true]);
            }
        }

        $address->delete();
        $this->reset('address_id');

        session()->flash('message', 'Địa chỉ đã được xóa thành công.');
    }
    public function render()
    {
        $user = auth()->user();  
        $addresses = Address::where("user_id", $user->id)->get();
        return view('livewire.user.user-profile-component',['user'=>$user,'addresses'=>$addresses]);
    }
}
