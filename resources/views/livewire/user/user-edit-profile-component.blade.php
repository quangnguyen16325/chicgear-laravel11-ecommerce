<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>                    
                <span></span><a href="{{ route('user.dashboard') }}">Tài khoản của tôi</a> 
                <span></span><a href="{{ route('user.profile') }}">Thông tin cá nhân</a> 
                <span></span> Chỉnh sửa thông tin cá nhân
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="mb-3">
            <a href="{{ route('user.profile') }}" class="text-muted small hover-link"><< Quay lại trang thông tin cá nhân</a>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Chỉnh sửa thông tin cá nhân</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
    
                        <form wire:submit.prevent="updateProfile">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên:</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
                            </div>
    
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" wire:model="email">
                                @error('email') 
                                    <span class="text-danger">{{ $message }}</span> 
                                @enderror
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
