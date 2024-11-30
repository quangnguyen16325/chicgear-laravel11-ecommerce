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
                <span></span> Danh sách đơn hàng
            </div>
        </div>
    </div>
    {{-- <div class="mb-2 mt-2">
        <a href="{{ route('user.profile') }}" class="text-muted small hover-link m-4"><< Quay lại trang cá nhân</a>
    </div> --}}
    <h4 class="text-center mb-4 mt-4">Danh sách Đơn Hàng</h4>
    <div class="row justify-content-center">
        @php
            $statusMap = [
                'pending' => 'Chờ xác nhận',
                'confirmed' => 'Đã xác nhận',
                'shipping' => 'Đang giao hàng',
                'delivered' => 'Đã giao hàng',
                'user_confirmed' => 'Người dùng đã xác nhận',
            ];
        @endphp
        @foreach($orders as $order)
        <div class="col-md-8 mb-3 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Mã đơn hàng: {{ $order->order_code }}</h5>
                    <span class="badge {{ $order->status == 'delivered' ? 'bg-success' : ($order->status == 'user_confirmed' ? 'bg-primary' : 'bg-warning') }}">
                        {{ $statusMap[$order->status] ?? 'Không xác định' }}
                    </span>
                </div>
                <div class="card-body">
                    <p><strong>Ngày đặt hàng:</strong> Ngày {{ $order->created_at->format('d/m/Y')}} lúc {{ $order->created_at->format('H:i') }}</p>
                    {{-- <p class="fw-bold">VAT: <span class="text-danger">{{ $order->tax_percentage }} %</span></p> --}}
                    <p class="fw-bold">Tổng giá trị: <span class="text-danger">{{ number_format($order->total, 0, ',', '.') }} VND</span></p>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('user.order.details', $order->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
                        {{-- <a href="#" class="btn btn-info btn-sm">Xem chi tiết</a> --}}
                        @if($order->status == 'delivered')
                            <button class="btn btn-success btn-sm" wire:click="confirmReceived({{ $order->id }})">Xác nhận đã nhận hàng</button>
                        @elseif($order->status == 'pending')
                            <button class="btn btn-danger btn-sm" onclick="cancelOrderConfirmation({{ $order->id }})">Hủy đơn hàng</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Modal xác nhận hủy đơn hàng -->
    <div class="modal" id="cancelOrderConfirmation" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pb-30 pt-30">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="pb-3">Bạn có chắc chắn muốn hủy đơn hàng này không?</h4>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cancelOrderConfirmation">Không</button>
                            <button type="button" class="btn btn-danger" onclick="cancelOrder()">Hủy đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        function cancelOrderConfirmation(id)
        {
            @this.set('orderIdToCancel',id);
            $('#cancelOrderConfirmation').modal('show');
        }  
        
        function cancelOrder()
        {
            @this.call('cancelOrder');
            $('#cancelOrderConfirmation').modal('hide');
        }
    </script>    
@endpush