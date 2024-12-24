<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>
                <span></span><a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                <span></span><a href="{{ route('admin.discount_codes') }}">Danh sách mã giảm giá</a>
                <span></span> Phát mã giảm giá cho người dùng
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
                        <h4>Phát mã giảm giá cho người dùng</h4>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="distributeDiscountCode">
                            <!-- Chọn mã giảm giá -->
                            <div class="mb-3">
                                <label class="form-label">Chọn mã giảm giá:</label>
                                <select class="form-control" wire:model="selectedDiscountCode">
                                    <option value="">-- Chọn mã giảm giá --</option>
                                    @foreach($discountCodes as $discountCode)
                                        <option value="{{ $discountCode->id }}">
                                            {{ $discountCode->code }} - {{ $discountCode->percentage }}% giảm
                                        </option>
                                    @endforeach
                                </select>
                                @error('selectedDiscountCode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Checkbox phát cho tất cả người dùng -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" wire:model="distributeToAll">
                                <label class="form-check-label" for="distributeToAll">Phát cho tất cả người dùng</label>
                            </div>

                            <!-- ID người dùng nếu phát cho một người -->
                            <div class="mb-3">
                                <label class="form-label">ID người dùng (nếu phát cho một người):</label>
                                <input type="text" class="form-control" wire:model="userId" placeholder="Nhập ID người dùng">
                                @error('userId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email người dùng nếu phát cho một người -->
                            <div class="mb-3">
                                <label class="form-label">Email người dùng (nếu phát cho một người):</label>
                                <input type="email" class="form-control" wire:model="userEmail" placeholder="Nhập email người dùng">
                                @error('userEmail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Phát mã giảm giá</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
