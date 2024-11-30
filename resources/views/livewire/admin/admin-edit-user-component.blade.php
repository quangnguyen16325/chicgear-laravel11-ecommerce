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
                    <span></span> <a href="{{ route('admin.users') }}">Quản lý người dùng</a>
                    <span></span> Chỉnh sửa người dùng
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <h4>Chỉnh sửa thông tin người dùng</h4>
                            </div>
                            <div class="card-body">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">{{ session('message') }}</div>
                                @endif

                                <form wire:submit.prevent="updateUser">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Họ và Tên</label>
                                        <input type="text" id="name" class="form-control" wire:model="name">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" class="form-control" wire:model="email">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="utype" class="form-label">Quyền</label>
                                        <select id="utype" class="form-control" wire:model="utype">
                                            <option value="ADM">Admin</option>
                                            <option value="USR">Người dùng</option>
                                        </select>
                                        @error('utype') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mật khẩu (Để trống nếu không đổi)</label>
                                        <input type="password" id="password" class="form-control" wire:model="password">
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    <a href="{{ route('admin.users') }}" class="btn btn-secondary">Hủy</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
