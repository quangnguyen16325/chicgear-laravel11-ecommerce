
<div>
    <style>
        nav svg {
            height: 20px;
        }
        nav .hidden {
            display: block;
        }
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                    <span></span> Quản lý người dùng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    Tất cả người dùng
                                </div> --}}
                                <div class="col-md-6 d-flex align-items-center">
                                    <h5 class="mb-0">Tất cả người dùng</h5>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <!-- Thanh tìm kiếm -->
                                    <input type="text" class="form-control mb-0 me-2" placeholder="Tìm kiếm tài khoản..." 
                                        wire:model.live.debounce.300ms="search" style="max-width: 300px;" />
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (session()->has('message'))
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Họ và Tên</th>
                                        <th>Email</th>
                                        <th>Quyền</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = ($users->currentPage()-1)*$users->perPage();
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->utype == 'ADM-M')
                                                    Quản trị viên chính
                                                @elseif($user->utype == 'ADM')
                                                    Quản trị viên
                                                @else
                                                    Người dùng
                                                @endif
                                            </td>                                            
                                            <td>
                                                @if(auth()->user()->utype === 'ADM-M' || (auth()->user()->utype === 'ADM' && $user->utype === 'USR'))
                                                    <a href="{{ route('admin.user.edit', ['user_id' => $user->id]) }}" class="text-info">Sửa</a>
                                                    <a href="#" class="text-danger" onclick="deleteConfirmation({{ $user->id }})" style="margin-left: 20px;">Xóa</a>
                                                @else
                                                    <a href=""></a>
                                                @endif  
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal" id="deleteConfirmation" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pb-30 pt-30">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="pb-3">Bạn có chắc chắn muốn xóa?</h4>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Hủy bỏ</button>
                            <button type="button" class="btn btn-danger" onclick="deleteUser()">Xóa</button>
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
            @this.set('user_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteUser()
        {
            @this.call('deleteUser');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush    

