<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>                    
                <span></span><a href="{{ route('admin.dashboard') }}">Trang quản trị</a> 
                <span></span> <a href="{{ route('admin.discount_codes') }}">Danh sách mã giảm giá</a>
                <span></span> Thêm mã giảm giá
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="mb-3">
            <a href="{{ route('admin.discount_codes') }}" class="text-muted small hover-link"><< Quay lại Danh sách mã giảm giá</a>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Thêm mã giảm giá</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="storeDiscountCode">
                            <div class="mb-3">
                                <label class="form-label">Mã giảm giá:</label>
                                <input type="text" class="form-control" wire:model="code">
                                @error('code') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tên mã giảm giá:</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phần trăm giảm giá:</label>
                                <input type="number" class="form-control" wire:model="percentage">
                                @error('percentage') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số lượng:</label>
                                <input type="number" class="form-control" wire:model="quantity">
                                @error('quantity') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="allUsers" wire:model="distributed_to_all">
                                    <label class="form-check-label" for="allUsers">Tất cả người dùng có thể sử dụng</label>
                                </div>
                                @error('distributed_to_all') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Lưu mã giảm giá</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
