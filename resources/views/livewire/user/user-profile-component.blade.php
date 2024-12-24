<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    @if(Auth::user()->utype == 'ADM' || Auth::user()->utype == 'ADM-M')                 
                        <span></span><a href="{{ route('admin.profile') }}">Trang cá nhân</a> 
                    @else
                        <span></span><a href="{{ route('user.dashboard') }}">Trang khách hàng</a> 
                    @endif                    
                    {{-- <span></span><a href="{{ route('user.dashboard') }}">Tài khoản của tôi</a>  --}}
                    <span></span> Thông tin cá nhân
                </div>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Thông tin cá nhân</h4>
                            <p class="form-label">ID: <span>{{ $user->id }}</span></p>
                        </div>
                        <div class="card-body">
                            {{-- <div class="mb-3">
                                <p class="form-label">ID: <span>{{ $user->id }}</span></p>
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label">Họ và tên:</label>
                                <p>{{ $user->name }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ giao hàng:</label>
                                @if($addresses->isEmpty())
                                    <p class="text-muted">Bạn chưa thêm thông tin giao hàng nào. Vui lòng cập nhật thêm thông tin giao hàng.</p>
                                @else
                                    <div class="row">
                                        @foreach($addresses as $address)
                                        <div class="col-md-12">
                                            <div class="card mb-3">
                                                <div class="card-body d-flex justify-content-between align-items-center">
                                                    <div style="max-width: 500px; word-wrap: break-word; white-space: normal;">
                                                        <p><strong>Địa chỉ:</strong> {{ $address->address }}</p>
                                                        <p><strong>Số điện thoại:</strong> {{ $address->phone }}</p>
                                                        @if($address->is_default)
                                                            <span class="badge bg-danger text-white">Địa chỉ mặc định</span>
                                                        @endif
                                                    </div>
                                                    {{-- <a href="{{ route('user.address.edit', $address->id) }}" class="btn btn-warning btn-sm hover-btn">Chỉnh sửa</a>
                                                    <a href="#" class="btn btn-danger btn-sm hover-btn" onclick="deleteConfirmation({{ $address->id }})">Xóa</a> --}}
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('user.address.edit', $address->id) }}" class="btn btn-warning btn-sm hover-btn me-2">Chỉnh sửa</a>
                                                        <a href="#" class="btn btn-danger btn-sm hover-btn" onclick="deleteConfirmation({{ $address->id }})">Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                
                                        @endforeach
                                    </div>
                                @endif
                            <div class="text-center">
                                <a href="{{ route('user.address.create') }}" class="btn btn-success btn-hover" style="margin-right: 15px;">Thêm địa chỉ</a>
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-primary btn-hover">Chỉnh sửa thông tin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <div class="modal" id="deleteConfirmation" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pb-30 pt-30">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="pb-3">Bạn có chắc chắn muốn xóa địa chỉ này?</h4>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Hủy bỏ</button>
                            <button type="button" class="btn btn-danger" onclick="deleteAddress()">Xóa</button>
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
            @this.set('address_id',id);
            $('#deleteConfirmation').modal('show');
        }  
        
        function deleteAddress()
        {
            @this.call('deleteAddress');
            $('#deleteConfirmation').modal('hide');
        }
    </script>    
@endpush