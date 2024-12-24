<?php

namespace App\Livewire\Admin;

use App\Models\DiscountCode;
use App\Models\User;
use App\Models\UserDiscount;
use Livewire\Component;

class AdminDistributeDiscountCodeComponent extends Component
{
    public $selectedDiscountCode;
    public $distributeToAll = false;
    public $userId;
    public $userEmail;
    public $discountCodes;

    public function mount()
    {
        // Lấy danh sách mã giảm giá
        $this->discountCodes = DiscountCode::all();
    }

    public function distributeDiscountCode()
    {
        // Kiểm tra lựa chọn mã giảm giá
        $this->validate([
            'selectedDiscountCode' => 'required|exists:discount_codes,id',
            'userId' => 'nullable|exists:users,id',
            'userEmail' => 'nullable|email|exists:users,email',
        ]);

        $discountCode = DiscountCode::find($this->selectedDiscountCode);

        if ($discountCode->quantity <= 0) {
            session()->flash('error', 'Mã giảm giá này đã hết số lượng!');
            return;
        }

        // Nếu phát cho tất cả người dùng
        if ($this->distributeToAll) {
            $users = User::where('utype', 'USR')->get();
            foreach ($users as $user) {
                // $user->discountCodes()->attach($discountCode->id, ['used' => false]);
                if (!$user->discountCodes()->where('discount_code_id', $discountCode->id)->exists()) {
                    $user->discountCodes()->attach($discountCode->id, ['used' => false]);
                    $discountCode->quantity -= 1;
    
                    if ($discountCode->quantity <= 0) {
                        break;
                    }
                }
            }
        }
        // Nếu phát cho người dùng theo ID
        elseif ($this->userId) {
            $user = User::find($this->userId);
            if ($user) {
                $user->discountCodes()->attach($discountCode->id, ['used' => false]);
            } else {
                session()->flash('error', 'Không tìm thấy người dùng với ID này!');
            }
        }
        // Nếu phát cho người dùng theo Email
        elseif ($this->userEmail) {
            $user = User::where('email', $this->userEmail)->first();
            if ($user) {
                $user->discountCodes()->attach($discountCode->id, ['used' => false]);
            } else {
                session()->flash('error', 'Không tìm thấy người dùng với email này!');
            }
        }

        $discountCode->save();

        session()->flash('message', 'Mã giảm giá đã được phát thành công!');
        return redirect()->route('admin.discount_codes');
    }
    public function render()
    {
        return view('livewire.admin.admin-distribute-discount-code-component');
    }
}
