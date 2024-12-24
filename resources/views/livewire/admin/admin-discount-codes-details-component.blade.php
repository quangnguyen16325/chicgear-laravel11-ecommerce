<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>             
                    <span></span> <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>       
                    <span></span><a href="{{ route('admin.discount_codes') }}">Quản lý mã giảm giá</a> 
                    <span></span> Chi tiết mã giảm giá
                </div>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <div class="mb-3">
                <a href="{{ route('admin.discount_codes') }}" class="text-muted small hover-link"><< Quay lại danh sách mã giảm giá</a>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Chi tiết mã giảm giá</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Mã giảm giá:</label>
                                <p>{{ $discountCode->code }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tên mã giảm giá:</label>
                                <p>{{ $discountCode->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tỷ lệ giảm giá:</label>
                                <p>{{ $discountCode->percentage }}%</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ngày tạo:</label>
                                <p>{{ $discountCode->created_at }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Danh sách khách hàng nhận mã giảm giá:</label>
                                <ul>
                                    @if($discountCode->distributed_to_all)
                                        <!-- Nếu distributed_to_all là true, hiển thị chỉ một dòng thông báo -->
                                        <strong style="color: red">Tất cả người dùng</strong>
                                    @else
                                        <!-- Nếu không phải distributed_to_all, hiển thị danh sách người dùng nhận mã -->
                                        @foreach($discountCode->users as $user)
                                            <li>
                                                {{ $user->id }} - {{ $user->name }} - 
                                                <span class="badge {{ $user->pivot->used ? 'bg-danger' : 'bg-success' }}">
                                                    {{ $user->pivot->used ? 'Đã sử dụng' : 'Chưa sử dụng' }}
                                                </span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <p class="fw-bold">Tổng số lần sử dụng: <span class="text-danger">{{ $discountCode->used_quantity }}</span></p><br>
                                <label class="form-label fw-bold">Số lượng còn lại:</label>
                                <p class="text-danger fw-bold">{{ $discountCode->quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
