<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>   
                    @if(Auth::user()->utype == 'ADM' || Auth::user()->utype == 'ADM-M')                 
                        <span></span> <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                        <span></span> <a href="{{ route('admin.order.history') }}">Lịch sử đơn hàng</a>
                    @else
                    <span></span><a href="{{ route('user.order.histories') }}">Đơn hàng của tôi</a>  
                    @endif                 
                    {{-- <span></span><a href="{{ route('user.order.histories') }}">Đơn hàng của tôi</a>  --}}
                    <span></span> Chi tiết đơn hàng
                </div>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <div class="mb-3">
                @if(Auth::user()->utype == 'ADM' || Auth::user()->utype == 'ADM-M')  
                    <a href="{{ route('admin.order.history') }}" class="text-muted small hover-link"><< Quay lại danh sách lịch sử đơn hàng</a>
                @else
                <a href="{{ route('user.order.histories') }}" class="text-muted small hover-link"><< Quay lại danh sách đơn hàng</a>
                @endif
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    @if($order->status == 'expired_confirmed')
                        <div class="alert alert-warning mt-3">
                            <p class="mb-2"><strong>Thông báo:</strong></p>
                            <p>Đơn hàng này đã quá hạn xác nhận từ ngày nhận hàng thành công, vui lòng xác nhận lại!</p>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Chi tiết đơn hàng</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Mã đơn hàng:</label>
                                <p>{{ $order->order_code }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Khách hàng:</label>
                                <p>{{ $order->fullname }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email khách hàng:</label>
                                <p>{{ $order->email }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái:</label>
                                <p>
                                    @switch($order->status)
                                        @case('pending') Chờ xác nhận @break
                                        @case('confirmed') Đã xác nhận @break
                                        @case('shipping') Đang giao hàng @break
                                        @case('delivered') Đã giao hàng @break
                                        @case('user_confirmed') Giao hàng thành công @break
                                        @case('canceled') Đơn hàng đã hủy @break
                                        @case('expired_confirmed') Giao hàng thành công - Quá hạn xác nhận @break
                                        @default Không xác định
                                    @endswitch
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày tạo:</label>
                                <p>Ngày {{ $order->created_at->format('d/m/Y')}} lúc {{ $order->created_at->format('H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Danh sách sản phẩm:</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Tổng phụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->product->name ?? 'Không xác định' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="fw-bold">VAT: <span class="text-danger">{{ $order->tax_percentage }} %</span></p>
                                <label class="form-label fw-bold">Tổng tiền:</label>
                                <p class="text-danger fw-bold">{{ number_format($order->total, 0, ',', '.') }} VNĐ</p>
                            </div>
                            @if($order->status == 'expired_confirmed')
                                {{-- <div class="alert alert-warning mt-3">
                                    <p class="mb-2"><strong>Thông báo:</strong></p>
                                    <p>Đơn hàng này đã quá hạn xác nhận từ ngày nhận hàng thành công, vui lòng xác nhận lại!</p>
                                </div> --}}
                                <div class="d-flex justify-content-end mt-3">
                                    <button wire:click="confirmOrder('{{ $order->order_code }}')" class="btn btn-primary">Xác nhận đã nhận hàng</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
