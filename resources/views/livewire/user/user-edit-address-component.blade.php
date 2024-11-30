
    <div>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>                    
                    <span></span><a href="{{ route('user.dashboard') }}">Tài khoản của tôi</a> 
                    <span></span><a href="{{ route('user.profile') }}">Thông tin cá nhân</a> 
                    <span></span> Chỉnh sửa địa chỉ và số điện thoại
                </div>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <div class="mb-3">
                <a href="{{ route('user.profile') }}" class="text-muted small hover-link"><< Quay lại trang thông tin cá nhân</a>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Chỉnh sửa địa chỉ và số điện thoại</h4>
                        </div>
                        <div class="card-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
    
                            <form wire:submit.prevent="updateAddress">
                                <div class="mb-3">
                                    <label class="form-label">Địa chỉ:</label>
                                    <input type="text" class="form-control" wire:model="address">
                                    @error('address') 
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
    
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại:</label>
                                    <input type="text" class="form-control" wire:model="phone">
                                    @error('phone') 
                                        <span class="text-danger">{{ $message }}</span> 
                                    @enderror
                                </div>
    
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" wire:model="is_default">
                                    <label class="form-check-label" for="is_default">Đặt là địa chỉ mặc định</label>
                                </div>
    
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

