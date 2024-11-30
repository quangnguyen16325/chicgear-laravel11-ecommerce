<div>
    <style>
        nav svg{
            height: 20px;
        }
        nav .hidden{
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Trang chủ</a>
                    <span></span> <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                    <span></span> <a href="{{ route('admin.home.slider') }}">Sliders</a>
                    <span></span> Chỉnh sửa trình chiếu 
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    Chỉnh sửa trình chiếu 
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.home.slider') }}" class="btn btn-success float-end">Tất cả trình chiếu</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form wire:submit.prevent="updateSlide">
                                <div class="mb-3 mt-3">
                                    <label class="form-label">Tiều đề chính</label>
                                    <input type="text" class="form-control" placeholder="Điền tiêu đề chính" wire:model="top_title">
                                    @error('top_title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Tiều đề</label>
                                    <input type="text" class="form-control" placeholder="Điền tiêu đề" wire:model="title">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Phụ đề</label>
                                    <input type="text" class="form-control" placeholder="Điền phụ đề" wire:model="sub_title">
                                    @error('sub_title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Ưu đãi</label>
                                    <input type="text" class="form-control" placeholder="Điền ưu đãi" wire:model="offer">
                                    @error('offer')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Liên kết</label>
                                    <input type="text" class="form-control" placeholder="Điền liên kết" wire:model="link">
                                    @error('link')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select class="form-control" wire:model="status">
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Không hoạt động</option>
                                    </select>
                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Hình ảnh</label>
                                    <input type="file" class="form-control" wire:model="newImage"> 
                                    @if ($newImage)
                                        <img src="{{ $newImage->temporaryUrl() }}" alt="" width="100">
                                    @else 
                                        <img src="{{ asset('assets/imgs/slider') }}/{{ $image }}" alt="" width="100">
                                    @endif
                                    @error('newImage')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
