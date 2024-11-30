<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminProfileComponent extends Component
{
    public function render()
    {
        $user = auth()->user();  
        $orderCount = $user->orders()->whereNotIn('status', ['canceled', 'user_confirmed','expired_confirmed'])->count();
        return view('livewire.admin.admin-profile-component',[
            'user'=>$user,
            'orderCount'=>$orderCount,
        ]);
    }

}
