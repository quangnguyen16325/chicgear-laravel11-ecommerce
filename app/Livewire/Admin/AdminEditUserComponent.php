<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AdminEditUserComponent extends Component
{
    public $user_id;
    public $name;
    public $email;
    public $utype; 
    public $password;

    public function mount($user_id)
    {
        $user = User::findOrFail($user_id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->utype = $user->utype;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'utype' => 'required|in:ADM,USR',
            'password' => 'nullable|min:8', 
        ]);

        $user = User::findOrFail($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->utype = $this->utype;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        session()->flash('message', 'Thông tin người dùng đã được cập nhật thành công!');
        return redirect()->route('admin.users'); 
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-user-component');
    }
}
