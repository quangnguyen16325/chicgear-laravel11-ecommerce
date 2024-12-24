<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>
                <span></span> Danh sách mã giảm giá
            </div>
        </div>
    </div>
    <h4 class="text-center mb-4 mt-4">Danh sách mã giảm giá</h4>

    <div class="col-md-8 mb-3 mx-auto">
        <!-- Thanh tìm kiếm -->
        <input type="text" class="form-control mb-0 me-2" placeholder="Tìm kiếm mã giảm giá..." wire:model.live.debounce.300ms="search" style="max-width: 300px;" />
    </div>

    <div class="row justify-content-center">
        @foreach($discountCodes as $discountCode)
        <div class="col-md-8 mb-3 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Mã: {{ $discountCode->code }}</h5>
                    <span class="badge {{ $discountCode->users->first()->pivot->used ? 'bg-danger' : 'bg-success' }}">
                        {{ $discountCode->users->first()->pivot->used ? 'Đã sử dụng' : 'Chưa sử dụng' }}
                    </span>
                </div>
                <div class="card-body">
                    <p><strong>Tên mã:</strong> {{ $discountCode->name }}</p>
                    <p><strong>Phần trăm giảm:</strong> {{ $discountCode->percentage }}% giảm</p>
                    {{-- <div class="d-flex justify-content-end">
                        <a href="" class="btn btn-primary btn-sm">Xem chi tiết</a>
                    </div> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $discountCodes->links() }}
    </div>
</div>
