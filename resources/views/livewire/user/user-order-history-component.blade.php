<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>   
                @if(Auth::user()->utype == 'ADM' || Auth::user()->utype == 'ADM-M')                 
                    <span></span><a href="{{ route('admin.profile') }}">Trang cá nhân</a> 
                @else
                    <span></span><a href="{{ route('user.dashboard') }}">Trang khách hàng</a> 
                @endif
                <span></span> Lịch sử đơn hàng
            </div>
        </div>
    </div>
    <h4 class="text-center mb-4 mt-4">Danh sách lịch sử đơn hàng</h4>
    <div class="row justify-content-center">
        @php
            $statusMap = [
                'pending' => 'Chờ xác nhận',
                'confirmed' => 'Đã xác nhận',
                'shipping' => 'Đang giao hàng',
                'delivered' => 'Đã giao hàng',
                'user_confirmed' => 'Đã giao hàng thành công',
                'expired_confirmed' => 'Đã giao hàng thành công',
                'canceled' => 'Đơn hàng đã hủy'
            ];
        @endphp
        @foreach($orders as $order)
        <div class="col-md-8 mb-3 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Mã đơn hàng: {{ $order->order_code }}</h5>
                    <div class="d-flex justify-content-end ms-auto">
                        @if ($order->status == 'expired_confirmed')
                            <span class="badge bg-warning">Quá hạn xác nhận</span>
                        @endif
                    </div>
                    <span class="m-2 badge {{ $order->status == 'user_confirmed' ? 'bg-primary' : ($order->status == 'canceled' ? 'bg-danger' : 'bg-primary') }}">
                        {{ $statusMap[$order->status] ?? 'Không xác định' }}
                    </span>
                    {{-- <span class="badge 
                        {{ 
                            $order->status == 'delivered' ? 'bg-success' : 
                            ($order->status == 'user_confirmed' ? 'bg-primary' : 
                            ($order->status == 'canceled' ? 'bg-danger' : 'bg-info')) 
                        }}">
                        {{ $statusMap[$order->status] ?? 'Không xác định' }}
                    </span> --}}
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <p><strong>Ngày đặt hàng:</strong> Ngày {{ $order->created_at->format('d/m/Y')}} lúc {{ $order->created_at->format('H:i') }}</p>
                        {{-- @if($order->status == 'expired_confirmed')
                            <div class="card shadow-sm p-2 mb-3">
                                <span class="text-danger fw-bold">Quá hạn xác nhận</span>
                            </div>
                        @endif --}}
                    </div>
                    <p class="fw-bold">Tổng giá trị: <span class="text-danger">{{ number_format($order->total, 0, ',', '.') }} VND</span></p>
                    @if($order->status == 'expired_confirmed')
                        <div class="alert alert-warning mt-3">
                            {{-- <p class="mb-2"><strong>Thông báo:</strong></p> --}}
                            <p><strong>Lưu ý:</strong> Đơn hàng này đã quá hạn xác nhận từ ngày nhận hàng thành công, vui lòng <a href="{{ route('user.order.history.details', $order->id) }}">xác nhận lại!</a></p>
                        </div>
                    @endif
                    {{-- <p><strong>Danh sách sản phẩm:</strong></p>
                    <ul>
                        @foreach($order->items as $item)
                            <li>
                                {{ $item->product_name }} - 
                                Số lượng: {{ $item->quantity }} - 
                                Giá: {{ number_format($item->price, 0, ',', '.') }}đ
                            </li>
                        @endforeach
                    </ul> --}}
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('user.order.history.details', $order->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
