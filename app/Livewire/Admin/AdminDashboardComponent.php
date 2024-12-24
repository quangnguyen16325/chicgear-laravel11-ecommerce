<?php

namespace App\Livewire\Admin;

use App\Models\HomeSlider;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardComponent extends Component
{
    public $labels = [];
    public $data = [];
    public $year;

    public function mount()
    {
        $revenueData = DB::table('order_histories')
            ->selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            // ->whereYear('created_at', $this->year)
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        foreach ($revenueData as $item) {
            $this->labels[] = 'Tháng ' . $item->month;
            $this->data[] = $item->revenue;
        }
    }
    public function render()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $sliderCount = HomeSlider::count();
        $orderCount = Order::count();
        $discountCount = DiscountCode::count();
        $orderHistoryCount = OrderHistory::where('admin_confirmed', true)->count();
        $user = auth()->user(); 
        if ($user->utype === 'ADM') {
            $userCount = User::where('id', '<>', auth()->id())  // Trừ người dùng hiện tại
                             ->whereIn('utype', ['USR']) // Chỉ tính 'USR', loại trừ 'ADM' và 'ADM-M'
                             ->count();
        } else {
            $userCount = User::where('id', '<>', auth()->id())  // Trừ người dùng hiện tại
                             ->count();  // Không phân biệt vai trò
        }
        

        return view('livewire.admin.admin-dashboard-component', [
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
            'sliderCount'=> $sliderCount,
            'userCount'=> $userCount,
            'orderCount' => $orderCount,
            'orderHistoryCount' => $orderHistoryCount,
            'discountCount' => $discountCount,
            'user'=> $user,
            'labels' => $this->labels, 
            'data' => $this->data,
        ]);
    }
}
