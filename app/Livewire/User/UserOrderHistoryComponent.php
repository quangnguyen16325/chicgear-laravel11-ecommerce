<?php

namespace App\Livewire\User;

use App\Models\OrderHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserOrderHistoryComponent extends Component
{
    public $orders;

    public function mount()
    {
        // $this->orders = OrderHistory::with('items') 
        //     ->where('user_id', Auth::id())
        //     ->orderBy('created_at', 'desc')
        //     ->get();
        $this->orders = OrderHistory::with('items') 
        ->where('user_id', Auth::id())
        ->orderByRaw("
            FIELD(status, 'canceled', 'user_confirmed', 'expired_confirmed') DESC
        ") 
        ->orderBy('created_at', 'desc') 
        ->get();
    }

    public function render()
    {
        return view('livewire.user.user-order-history-component', [
            'orders' => $this->orders,
        ]);
    }
}
