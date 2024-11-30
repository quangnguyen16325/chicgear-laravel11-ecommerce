<div>
    <main class="main">
        {{-- <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>                    
                    <span></span><a href="{{ route('user.order') }}">Đơn hàng của tôi</a> 
                    <span></span> Chi tiết đơn hàng
                </div>
            </div>
        </div> --}}
        <div class="container mt-5 mb-5">
            <div class="mb-3">
                <a href="{{ route('user.order') }}" class="text-muted small hover-link"><< Quay lại danh sách đơn hàng</a>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
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
                                    @if($order->status == 'pending')
                                        Chờ xác nhận
                                    @elseif($order->status == 'confirmed')
                                        Đã xác nhận
                                    @elseif($order->status == 'shipping')
                                        Đang giao hàng
                                    @elseif($order->status == 'delivered')
                                        Đã giao hàng
                                    @else
                                        Không xác định
                                    @endif
                                </p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày đặt hàng:</label>
                                <p> Ngày {{ $order->created_at->format('d/m/Y')}} lúc {{ $order->created_at->format('H:i') }}</p>
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
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                                <td>{{ number_format($item->price*$item->quantity, 0, ',', '.') }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="mb-3 d-flex justify-content-between">
                                <label class="form-label fw-bold">VAT:</label>
                                <p class="text-danger fw-bold">{{ $order->tax_percentage }} %</p>
                            </div> --}}
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="fw-bold">VAT: <span class="text-danger">{{ $order->tax_percentage }} %</span></p><br>
                                <label class="form-label fw-bold">Tổng tiền:</label>
                                <p class="text-danger fw-bold">{{ number_format($order->total, 0, ',', '.') }} VNĐ</p>
                            </div>
                        </div>
                        {{-- <div class="card-footer text-center">
                            <a href="{{ route('admin.order') }}" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

