<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class UserDashboardComponent extends Component
{
    public function render()
    {
        

        $user = auth()->user(); 
        $orderCount = $user->orders()->whereNotIn('status', ['canceled', 'user_confirmed','expired_confirmed'])->count();
        
        return view('livewire.user.user-dashboard-component',[
            'user'=>$user,
            'orderCount' => $orderCount,
        ]);
    }
}
