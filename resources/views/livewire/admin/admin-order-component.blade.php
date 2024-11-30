<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                    <span></span> Quản lý đơn hàng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Quản lý đơn hàng
                                </div>
                                <div class="col-md-6 text-end">
                                    <input type="text" class="form-control mb-2" placeholder="Tìm kiếm..."
                                           wire:model.live.debounce.300ms="search" />
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <div class="col-md-12 text-end">
                                <button wire:click="updateOrderStatus()" class="btn btn-warning btn-sm mb-2">Cập nhật trạng thái đơn hàng</button>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                        <th>Chi tiết đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = ($orders->currentPage()-1)*$orders->perPage();
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $order->order_code }}</td>
                                            <td>{{ $order->fullname }}</td>
                                            <td>
                                                @if($order->status == 'pending')
                                                    <p class="badge bg-warning">Chờ xác nhận</p>
                                                @elseif($order->status == 'confirmed')
                                                    <p class="badge bg-info">Đã xác nhận</p>
                                                @elseif($order->status == 'shipping')
                                                    <p class="badge bg-success">Đang giao hàng</p>
                                                @elseif($order->status == 'delivered')
                                                    <p class="badge bg-primary">Đã giao hàng</p>
                                                @elseif($order->status == 'user_confirmed')
                                                     <p class="badge bg-success">Khách hàng đã xác nhận</p>
                                                @elseif($order->status == 'expired_confirmed')
                                                     <p class="badge bg-danger">Quá hạn xác nhận</p>
                                                @elseif($order->status == 'canceled')
                                                    <p class="badge bg-dark">Đơn hàng đã hủy</p>
                                                @else
                                                    Không xác định
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>
                                                @if($order->status == 'pending')
                                                    <button wire:click="changeStatus({{ $order->id }}, 'confirmed')" class="btn btn-info btn-sm">Xác nhận</button>
                                                @elseif($order->status == 'confirmed')
                                                    <button wire:click="changeStatus({{ $order->id }}, 'shipping')" class="btn btn-warning btn-sm">Đang giao hàng</button>
                                                @elseif($order->status == 'shipping')
                                                    <button wire:click="changeStatus({{ $order->id }}, 'delivered')" class="btn btn-success btn-sm">Đã giao hàng</button>
                                                @elseif($order->status == 'delivered')
                                                    <span>Chờ xác nhận từ khách hàng</span>
                                                @elseif($order->status == 'canceled')
                                                    <button wire:click="deleteOrder({{ $order->id }})" class="btn btn-danger btn-sm">Xóa đơn hàng</button>
                                                @elseif($order->status == 'user_confirmed' || 'expired_confirmed')
                                                    <button wire:click="changeStatus({{ $order->id }}, 'completed')" class="btn btn-light btn-sm">Hoàn thành đơn hàng</button>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('admin.order.details', ['order_id' => $order->id]) }}" class="btn btn-primary btn-sm">Xem chi tiết</a> --}}
                                                <a href="{{ route('admin.order.details', ['order_id' => $order->id]) }}" class="mt-3 hover-link">Xem chi tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                    </div>       
                </div>
            </div>
        </section>
    </main>  
</div>
