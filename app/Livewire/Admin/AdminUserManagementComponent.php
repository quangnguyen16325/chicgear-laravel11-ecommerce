<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUserManagementComponent extends Component
{
    use WithPagination;

    public $user_id;
    public $search = '';

    protected $listeners = ['deleteUser'];

    public function deleteUser()
    {
        $user = User::find($this->user_id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'Người dùng đã được xóa thành công!');
        }
    }

    public function render()
    {
        // $users = User::where('id', '<>', Auth::id())
        //             ->orderByRaw("FIELD(utype, 'ADM-M', 'ADM', 'USR')")
        //             ->paginate(10);
        $users = User::where('id', '<>', Auth::id())
                    ->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')
                              ->orWhere('email', 'like', '%' . $this->search . '%');
                    })
                    ->orderByRaw("FIELD(utype, 'ADM-M', 'ADM', 'USR')")
                    ->paginate(10);

        return view('livewire.admin.admin-user-management-component',[
            'users'=> $users,
        ]);
    }
}
