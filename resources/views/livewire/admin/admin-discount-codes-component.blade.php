<div>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow">Trang chủ</a>
                <span></span> <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                <span></span> Danh sách mã giảm giá
            </div>
        </div>
    </div>
    <h4 class="text-center mb-4 mt-4">Danh sách mã giảm giá</h4>
    {{-- <div class="col-md-8 mb-3 mx-auto">
        <input type="text" class="form-control mb-0 me-2" placeholder="Tìm kiếm mã giảm giá..." wire:model.live.debounce.300ms="search" style="max-width: 300px;" />
    </div> --}}
    <div class="col-md-8 mb-3 mx-auto d-flex justify-content-between align-items-center">
        <!-- Thanh tìm kiếm -->
        <input type="text" class="form-control mb-0 me-2" placeholder="Tìm kiếm mã giảm giá..." wire:model.live.debounce.300ms="search" style="max-width: 300px;" />
        <div class="d-flex">
            <!-- Nút phát mã giảm giá -->
            <a href="{{ route('admin.distribute_discount_code') }}" class="btn btn-warning mb-0 me-2">Phát mã giảm giá</a>
            <!-- Nút thêm sản phẩm -->
            <a href="{{ route('admin.discount_codes.add') }}" class="btn btn-success mb-0">Thêm mã giảm giá</a>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach($discountCodes as $discountCode)
        <div class="col-md-8 mb-3 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Mã: {{ $discountCode->code }}</h5>
                    <span class="badge {{ $discountCode->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $discountCode->is_active ? 'Có hiệu lực' : 'Đã vô hiệu hóa' }}
                    </span>
                </div>
                <div class="card-body">
                    <p><strong>Tên mã:</strong> {{ $discountCode->name }}</p>
                    <p><strong>Phần trăm giảm:</strong> {{ $discountCode->percentage }}% giảm</p>
                    <p><strong>Số lượng:</strong> {{ $discountCode->quantity }}</p>
                    <p>
                        <strong>Người dùng được sử dụng:</strong>
                        @if($discountCode->distributed_to_all)
                            Tất cả người dùng
                        @else
                            {{ $discountCode->users->count() }}
                        @endif
                        </p> 
                    <ul>
                            {{-- @if($discountCode->users->count() > 5) 
                                @foreach($discountCode->users->take(5) as $user) 
                                    <li>
                                        {{ $user->id }} - {{ $user->name }} - 
                                        <span class="badge {{ $user->pivot->used ? 'bg-danger' : 'bg-success' }}">
                                            {{ $user->pivot->used ? 'Đã sử dụng' : 'Chưa sử dụng' }}
                                        </span>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="javascript:void(0)" onclick="showAllUsers()">Xem thêm {{ $discountCode->users->count() - 5 }} người dùng</a>
                                </li>
                            @else
                                @foreach($discountCode->users as $user)
                                    <li>
                                        {{ $user->id }} - {{ $user->name }} - 
                                        <span class="badge {{ $user->pivot->used ? 'bg-danger' : 'bg-success' }}">
                                            {{ $user->pivot->used ? 'Đã sử dụng' : 'Chưa sử dụng' }}
                                        </span>
                                    </li>
                                @endforeach
                            @endif --}}
                    </ul>
                    <div class="d-flex justify-content-end">
                        <div class="d-flex justify-content-start align-items-center">
                            @if($discountCode->is_active)
                                <button class="btn btn-success btn-sm" wire:click="toggleStatus({{ $discountCode->id }})">Vô hiệu hóa</button>
                            @else
                                <button class="btn btn-primary btn-sm" wire:click="toggleStatus({{ $discountCode->id }})">Kích hoạt</button>
                            @endif
                        </div>
                        <a href="{{ route('admin.discount_code.details', ['discount_id' => $discountCode->id]) }}" class="btn btn-primary btn-sm" style="margin-left: 20px;">Xem chi tiết</a>
                        <a href="{{ route('admin.discount_code.edit',['discount_id'=>$discountCode->id]) }}" class="btn btn-info btn-sm" style="margin-left: 20px;">Chỉnh sửa</a>
                        <a href="#" class="btn btn-info btn-sm" onclick="deleteConfirmation({{ $discountCode->id }})" style="margin-left: 20px;">Xóa</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $discountCodes->links() }}
    </div>

    <div class="modal" id="deleteConfirmation" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pb-30 pt-30">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="pb-3">Bạn có chắc chắn muốn xóa?</h4>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Hủy bỏ</button>
                            <button type="button" class="btn btn-danger" onclick="deleteDiscountCode()">Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        function deleteConfirmation(id)
        {
            @this.set('discount_id',id);
            $('#deleteConfirmation').modal('show');
        }  
        
        function deleteDiscountCode()
        {
            @this.call('deleteDiscountCode');
            $('#deleteConfirmation').modal('hide');
        }
    </script>    
    <script>
        function showAllUsers() {
            window.location.href = "{{ route('admin.discount_code.details', ['discount_id' => $discountCode->id]) }}"; 
        }
    </script>
@endpush