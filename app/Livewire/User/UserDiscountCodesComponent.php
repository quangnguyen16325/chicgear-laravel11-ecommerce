<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\DiscountCode;
use Illuminate\Support\Facades\Auth;

class UserDiscountCodesComponent extends Component
{
    use WithPagination;

    public $search;
    public function render()
    {
        $user = Auth::user();

        $discountCodes = DiscountCode::where('is_active', true) // Chỉ lấy mã giảm giá có hiệu lực
            ->where(function ($query) use ($user) {
                $query->where('distributed_to_all', true) // Mã giảm giá được phân phối cho tất cả người dùng
                    ->orWhereHas('users', function ($subQuery) use ($user) {
                        $subQuery->where('users.id', $user->id); // Hoặc mã giảm giá dành riêng cho người dùng hiện tại
                    });
            })
        ->where(function ($query) {
            $query->where('code', 'like', '%' . $this->search . '%') 
                  ->orWhere('name', 'like', '%' . $this->search . '%'); 
        })
        ->paginate(10);

        return view('livewire.user.user-discount-codes-component',[
            'discountCodes' => $discountCodes,
        ]);
    }
}
