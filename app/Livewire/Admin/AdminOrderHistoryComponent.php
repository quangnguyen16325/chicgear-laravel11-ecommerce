<?php

namespace App\Livewire\Admin;

use App\Models\OrderHistory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderHistoryComponent extends Component
{
    use WithPagination;

    // protected $paginationTheme = 'bootstrap'; 

    public function render()
    {
        $orders = OrderHistory::with('items') 
            ->where('admin_confirmed', true)
            ->orderByRaw("
                FIELD(status, 'expired_confirmed', 'user_confirmed', 'canceled') DESC
            ")
            ->orderBy('created_at', 'desc')
            ->paginate(10); 

        return view('livewire.admin.admin-order-history-component', [
            'orders' => $orders,
        ]);
    }
}
