<?php

namespace App\Livewire\User;

use App\Models\Order;
use Livewire\Component;

class UserOrderDetailsComponent extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::with('items')->findOrFail($this->order_id);

        return view('livewire.user.user-order-details-component',[
            'order' => $order,
        ]);
    }
}
